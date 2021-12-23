<?php

namespace App\Services\Facturacion\Adapters;

use App\Models\Sale;

class VoidedInputs
{
    public static function getVoidedServiceInputs(Sale $sale, Int $numeration, String $description): Array
    {

        $identifier = join('-', ['RA', now()->format('Ymd'), $numeration ]);

        $inputs = [
            'voided' => [
                'date_issue' => now()->format('Y-m-d'),
                'identifier' => $identifier,
                'description' => $description
            ],
            'sale' => [
                'date_reference' => $sale->date_issue,

                'voucher_type' => $sale->serie->voucherType->cod,
                'serie' => $sale->serie->serie,
                'document_number' => $sale->document_number
            ]
        ];

        return $inputs;
    }

}