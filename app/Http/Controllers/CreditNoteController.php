<?php

namespace App\Http\Controllers;

use App\Http\Resources\GlobalResource;
use App\Models\CreditNote;
use App\Models\CreditNoteDetail;
use App\Models\CreditNoteType;
use App\Models\IgvType;
use App\Models\Sale;
use App\Models\Serie;
use App\Models\VoucherType;
use App\Services\SunatService;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditNotes = CreditNote::with('serie.voucherType', 'sale.serie', 'sale.customer')->latest()->get();
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

        // Crear los detalles de la cotizacion
        foreach ($request->detail as $key => $detail) {

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
                    $subtotal = ($priceWithoutIgv * $detail['quantity']) - $detail['discount'];

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
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalFreeCreditNote += $total;
                    break;
                case 20:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalExoneratedCreditNote += $subtotal;
                    $totalCreditNote += $total;
                    break;
                case 30:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
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
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalCreditNote += $subtotal;
                    $totalFreeCreditNote += $total;
                    break;
                case 40:
                    $subtotal = ($detail['sale_price'] * $detail['quantity']) - $detail['discount'];
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

                'discount' => $detail['discount'],
                'price' => $detail['sale_price'],
                'quantity' => $detail['quantity'],

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
}
