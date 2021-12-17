<?php

namespace App\Services\Facturacion\Adapters;

use App\Models\Company;
use App\Models\Sale;

class VoidedInputs
{
    public static function getVoidedServiceInputs(Sale $sale, Company $company, Int $numeration, String $description): Array
    {

        $identifier = join('-', ['RA', now()->format('Ymd'), $numeration ]);

        $inputs = [
            'company' => [
                'is_demo' => $company->demo,
                'user_sol' => $company->user_sol,
                'password_sol' => $company->password_sol,

                'ruc' => $company->ruc,
                'comercial_name' => $company->comercial_name,
                'name' => $company->name
            ],
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