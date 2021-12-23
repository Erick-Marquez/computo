<?php

namespace App\Services\Facturacion\Adapters;

use App\Models\Company;

class CompanyInputs
{
    public static function getCompanyInputs(Company $company): Array
    {
        return [
            'is_demo' => $company->demo,
            'user_sol' => $company->user_sol,
            'password_sol' => $company->password_sol,

            'ruc' => $company->ruc,
            'comercial_name' => $company->comercial_name,
            'name' => $company->name
        ];
    }

}