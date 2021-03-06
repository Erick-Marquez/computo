<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Http\Resources\GlobalResource;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\SerieResource;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\CurrencyExchange;
use App\Models\Customer;
use App\Models\IdentificationDocument;
use App\Models\IgvType;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use App\Models\Serie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function availableQuotations()
    {
        $availableQuotations = Quotation::where('date_due', '>', Carbon::now())
            ->doesnthave('sale')
            ->with('customer.identificationDocument', 'user','serie', 'paymentTypes')
            ->withCount('sale')
            ->latest()
            ->paginate(intVal(request('perPage')));

        return GlobalResource::collection($availableQuotations);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unavailableQuotations()
    {
        $unavailableQuotations = Quotation::has('sale')
            ->orWhere('date_due', '<', Carbon::now())
            ->with('customer.identificationDocument', 'user','serie')
            ->withCount('sale')
            ->latest()
            ->paginate(intVal(request('perPage')));

        return GlobalResource::collection($unavailableQuotations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identificationDocuments = IdentificationDocument::all();
        $currencyExchange = CurrencyExchange::latest()->first();
        $igvTypes = IgvType::all();

        $series = Serie::where('branch_id', auth()->user()->branch_id)->where('voucher_type_id', 8)->get(); //voucher type 8 = cotizacion
        $sellers = User::where('branch_id', auth()->user()->branch_id)->role('Vendedor')->get(); //voucher type 8 = cotizacion

        return GlobalResource::make([
            'currencyExchange' => $currencyExchange,
            'identificationDocuments' => $identificationDocuments,
            'igvTypes' => $igvTypes,

            'series' => $series,
            'sellers' => $sellers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationRequest $request)
    {

        if (is_null($request->customer['id'])) {

            $customer = Customer::updateOrCreate(
                ['document' => $request->customer['document']],
                [
                    'name' => $request->customer['name'],
                    'phone' => isset($request->customer['phone']) ? $request->customer['phone'] : null,
                    'address' => isset($request->customer['address']) ? $request->customer['address'] : null,
                    'ubigee_id' => isset($request->customer['ubigee_id']) ? $request->customer['ubigee_id'] : null,
                    'identification_document_id' => $request->customer['identification_document_id'],
                ]
            );

            $dataCustomer = $request->customer;
            $dataCustomer['id'] = $customer->id;

            $request->merge(['customer' => $dataCustomer]);
        }

        // Obtener la numeracion siguiente
        $serie = Serie::find($request->quotation['serie_id']);
        $serie->current_number = $serie->current_number + 1;
        $serie->save();

        // Crear la cotizacion
        $quotation = Quotation::create([

            'document_number' => $serie->current_number,
            'date_due' => $request->quotation['date_due'],

            'global_discount' => $request->quotation['discount'],

            'have_warranty' => $request->quotation['warranty'],

            'observation' => $request->quotation['observation'],

            'serie_id' => $request->quotation['serie_id'],
            'customer_id' => $request->customer['id'],
            'user_id' => $request->quotation['seller_id']
        ]);

        // Variables para los totales de la cotizacion
        $itemDiscount = 0;
        $subtotalQuotation = 0;
        $totalIgvQuotation = 0;
        $totalExoneratedQuotation = 0;
        $totalUnaffectedQuotation = 0;
        $totalFreeQuotation = 0;
        $totalTaxedQuotation = 0;
        $totalQuotation = 0;

        $igv = 0.18;
        // Crear los detalles de la cotizacion
        foreach ($request->detail as $detail) {

            $subtotal = 0;
            $totalIgv = 0;
            $total = 0;

            switch ($detail['igv_type_id']) {
                case 10:
                    // hallar el precio sin igv
                    $priceWithoutIgv = $detail['sale_price'] / (1 + $igv);

                    // hallar el subtotal = (precio sin igv * cantidad) - descuento
                    $subtotal = round($priceWithoutIgv * $detail['quantity'], 2);

                    // hallar el total = (subtotal * 1.18)
                    $total = round($subtotal * (1 + $igv), 2);

                    // hallar el igv = (total - subtotal)
                    $totalIgv = $total - $subtotal;

                    // Actualizar totales globales
                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalIgvQuotation += $totalIgv;
                    $totalTaxedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2);
                    $total = $subtotal;

                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalFreeQuotation += $total;
                    break;
                case 20:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2);
                    $total = $subtotal;

                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalExoneratedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 30:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2);
                    $total = $subtotal;

                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalUnaffectedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 31:
                case 32:
                case 33:
                case 34:
                case 35:
                case 36:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2);
                    $total = $subtotal;

                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalFreeQuotation += $total;
                    break;
                case 40:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2);
                    $total = $subtotal;

                    $itemDiscount += $detail['discount'];
                    $subtotalQuotation += $subtotal;
                    $totalUnaffectedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                default:
                    # code...
                    break;
            }

            $quotationDetails = QuotationDetail::create([

                'discount' => $detail['discount'],
                'price' => $detail['sale_price'],
                'unit_value' => ($total - $detail['discount']) / $detail['quantity'],
                'quantity' => $detail['quantity'],

                'total_igv' => $totalIgv,
                'subtotal' => $subtotal,
                'total' => $total,

                'igv_type_id' => $detail['igv_type_id'],
                'quotation_id' => $quotation->id,
                'branch_product_id' => $detail['product_id']

            ]);
        }

        $quotation->update([
            'item_discount' => $itemDiscount,
            'total_discount' => $itemDiscount + $request->quotation['discount'],
            'subtotal' => $subtotalQuotation,
            'total_igv' => $totalIgvQuotation,
            'total_exonerated' => $totalExoneratedQuotation,
            'total_unaffected' => $totalUnaffectedQuotation,
            'total_free' => $totalFreeQuotation,
            'total_taxed' => $totalTaxedQuotation,
            'total' => $totalQuotation
        ]);

        return $serie->serie . '-' .$quotation->document_number;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function print(Quotation $quotation)
    {
        $company = Company::active();
        $head = Quotation::where('id', $quotation->id)->with('quotationDetails.branchProduct.product', 'customer.identificationDocument', 'serie.voucherType')->firstOrFail();

        $details = $head->quotationDetails;

        $text = join('|', [
            $company->ruc,
            'Cotizacion',
            $head->serie->serie,
            $head->document_number,
            $head->total,
            $head->customer->identificationDocument->id,
            $head->customer->document,
        ]);

        $qr = base64_encode(QrCode::format('png')->size(200)->generate($text));


        $pdf = PDF::loadView('templates.pdf.quotation-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4','portrait');



        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }
}
