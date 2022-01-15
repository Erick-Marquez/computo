<?php

namespace App\Http\Controllers;

use App\Http\Resources\GlobalResource;
use App\Models\Company;
use App\Models\CreditNote;
use App\Models\CreditNoteDetail;
use App\Models\CreditNoteType;
use App\Models\IgvType;
use App\Models\Sale;
use App\Models\Serie;
use App\Models\VoucherType;
use App\Services\KardexService;
use App\Services\SunatService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditNotes = CreditNote::with('serie.voucherType', 'sale.serie', 'sale.customer')->latest()->paginate(intVal(request('perPage')));
        return GlobalResource::collection($creditNotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voucherTypes = VoucherType::whereIn('id', [1, 2])->get();
        $creditNotesTypes = CreditNoteType::all();
        $series = Serie::where('branch_id', auth()->user()->branch_id)
            ->whereNotIn('voucher_type_id', [3, 6, 7, 8, 9])
            ->get();
        $igvTypes = IgvType::all();

        return GlobalResource::make([
            'voucherTypes' => $voucherTypes,
            'creditNotesTypes' => $creditNotesTypes,
            'series' => $series,
            'igvTypes' => $igvTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serie = Serie::find($request->serie_id);
        $serie->current_number = $serie->current_number + 1;
        $serie->save();

        $creditNote = CreditNote::create([
            'document_number' => $serie->current_number,
            'date_issue' => now(),

            'observation' => CreditNoteType::find($request->credit_note_type_id)->description,
            'discount' => $request->discount,

            'credit_note_type_id' => $request->credit_note_type_id,
            'sale_id' => $request->sale_id,
            'serie_id' => $request->serie_id,
            'open_closed_cashbox_id' => auth()->user()->open_closed_cashbox_id,
            'user_id' => auth()->user()->id
        ]);

        // Variables para los totales de la venta
        $subtotalCreditNote = 0;
        $totalIgvCreditNote = 0;
        $totalExoneratedCreditNote = 0;
        $totalUnaffectedCreditNote = 0;
        $totalFreeCreditNote = 0;
        $totalTaxedCreditNote = 0;
        $totalCreditNote = 0;

        $igv = 0.18;

        // Crear los detalles de la nota de credito
        foreach ($request->details as $key => $detail) {

            $subtotal = 0;
            $totalIgv = 0;
            $total = 0;

            // ! EL PRECIO UNITARIO SE HALLA DIVIDIENDO EL TOTAL ENTRE LA CANTIDAD

            switch ($detail['igv_type_id']) {
                case 10:
                    // hallar el precio sin igv
                    $priceWithoutIgv = $detail['sale_price'] / (1 + $igv);

                    $detail['sale_price'] = $priceWithoutIgv;

                    // hallar el subtotal = (precio sin igv * cantidad) - descuento
                    $subtotal = $priceWithoutIgv * $detail['quantity'];

                    // hallar el total = (subtotal * 1.18)
                    $total = $subtotal * (1 + $igv);

                    // hallar el igv = (total - subtotal)
                    $totalIgv = $total - $subtotal;

                    // Actualizar totales globales
                    $subtotalCreditNote += $subtotal;
                    $totalIgvCreditNote += $totalIgv;
                    $totalTaxedCreditNote += $subtotal;
                    $totalCreditNote += $total;
                    break;
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                    $subtotal = $detail['sale_price'] * $detail['quantity'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalFreeCreditNote += $total;
                    break;
                case 20:
                    $subtotal = $detail['sale_price'] * $detail['quantity'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalExoneratedCreditNote += $subtotal;
                    $totalCreditNote += $total;
                    break;
                case 30:
                    $subtotal = $detail['sale_price'] * $detail['quantity'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalUnaffectedCreditNote += $subtotal;
                    $totalCreditNote += $total;
                    break;
                case 31:
                case 32:
                case 33:
                case 34:
                case 35:
                case 36:
                    $subtotal = $detail['sale_price'] * $detail['quantity'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalFreeCreditNote += $total;
                    break;
                case 40:
                    $subtotal = $detail['sale_price'] * $detail['quantity'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalUnaffectedCreditNote += $subtotal;
                    $totalCreditNote += $total;
                    break;
                default:
                    # code...
                    break;
            }

            CreditNoteDetail::create([

                'price' => $detail['sale_price'],
                'unit_value' => $total / $detail['quantity'],
                'quantity' => $detail['quantity'],

                'series' => $detail['series'],

                'total_igv' => $totalIgv,
                'subtotal' => $subtotal,
                'total' => $total,

                'igv_type_id' => $detail['igv_type_id'],
                'credit_note_id' => $creditNote->id,
                'branch_product_id' => $detail['product_id']

            ]);

        }

        $creditNote->update([
            'subtotal' => $subtotalCreditNote,
            'total_igv' => $totalIgvCreditNote,
            'total_exonerated' => $totalExoneratedCreditNote,
            'total_unaffected' => $totalUnaffectedCreditNote,
            'total_free' => $totalFreeCreditNote,
            'total_taxed' => $totalTaxedCreditNote,
            'total' => $totalCreditNote
        ]);

        switch ($request->credit_note_type_id) {
            case '01': //Anulación de la operación
            case '02': //Anulación por error en el RUC
            case '06': //Devolución total
            case '07': //Devolución por ítem
                
                foreach ($request->details as $detail) {

                    KardexService::creditNote(
                        $detail['quantity'],
                        $serie->serie . '-' . $creditNote->document_number,
                        $detail['series'],
                        $detail['product_id'],
                        auth()->user()->id);

                }

                break;
            
            default:
                # code...
                break;
        }

        $sunat = SunatService::facturar($creditNote->id, 'credit');

        $creditNote->update([
            'send_sunat' => $sunat['response']['send'],
            'state' => $sunat['response']['state'],
            'response_sunat' => $sunat['response']['response_sunat'],
            'description_sunat_cdr' => $sunat['response']['message'],
            'hash_cdr' => $sunat['response']['hash_cdr'],
            'hash_cpe' => $sunat['response']['hash_cpe']
        ]);

        return $creditNote->description_sunat_cdr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function voucher($serieId, $documentNumber)
    {
        $voucher = Sale::where('serie_id', $serieId)
            ->where('document_number', $documentNumber)
            ->where('canceled', 0)
            ->with('saleDetails.branchProduct.product.brand', 'customer.identificationDocument')
            ->firstOrFail();
        return GlobalResource::make($voucher);
    }

    public function print($type, $id)
    {
        $company = Company::active();
        $head = CreditNote::with('creditNoteDetails.branchProduct.product', 'sale.customer.identificationDocument', 'serie.voucherType')->findOrFail($id);

        $details = $head->creditNoteDetails;

        $text = join('|', [
            $company->ruc,
            $head->serie->voucherType->id,
            $head->serie->serie,
            $head->document_number,
            $head->total_igv,
            $head->total,
            $head->date_issue,
            $head->sale->customer->identificationDocument->id,
            $head->sale->customer->document,
            $head->hash_cpe
        ]);

        $qr = base64_encode(QrCode::format('png')->size(200)->generate($text));

        if ($type == 'A4') {
            $pdf = PDF::loadView('templates.pdf.credit-note-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4', 'portrait');
        }

        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }
}
