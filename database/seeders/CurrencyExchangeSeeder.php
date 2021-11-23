<?php

namespace Database\Seeders;

use App\Models\CurrencyExchange;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyExchange::create([
            'date' => Carbon::now()->toDateTimeString(), 
            'change' => 3.97
        ]);
    }
}
