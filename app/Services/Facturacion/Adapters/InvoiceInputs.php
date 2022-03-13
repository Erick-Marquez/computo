<?php

namespace App\Services\Facturacion\Adapters;

use App\Models\Sale;

class InvoiceInputs
{
    public static function getInvoiceServiceInputs(Sale $sale): Array
    {

        return [

            'customer' => [

            ],

            'head' => [
                'serie' => $sale->serie->serie,
                'document_number' => $sale->document_number,
                'date_issue' => $sale->date_issue,
                'time_issue' => date_format($sale->created_at, 'H:i:s'),
                'date_due' => $sale->date_due,
                'voucher_type' => $sale->serie->voucherType->cod
            ],

            'details' => [

            ]

        ];

    }

}