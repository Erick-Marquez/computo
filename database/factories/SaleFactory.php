<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_number' => $this->faker->numberBetween($min = 1, $max = 100),
            'date_issue' => $this->faker->dateTimeBetween($startDate = '2021-10-04', $endDate = 'now', $timezone = null)->format("Y-m-d"),
            // 'date_due' => $this->faker,
            // 'subtotal' => $this->faker,
            // 'discount' => $this->faker,
            'total_igv' => 0,
            'total_exonerated' => 0,
            'total_unaffected' => 0,
            'total_free' => 0,
            'total_taxed' => 0,
            'total' => $this->faker->numberBetween($min = 100, $max = 5000),
            // 'observation' => $this->faker,
            // 'received_money' => $this->faker,
            // 'change' => $this->faker,
            'have_warranty' => 0,
            // 'state' => $this->faker,
            'send_sunat' => 0,
            'response_sunat' => 0,
            // 'description_sunat_cdr' => $this->faker,
            // 'hash_cdr' => $this->faker,
            // 'canceled' => $this->faker,
            'serie_id' => Serie::where('branch_id', 1)->get()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            // 'open_closed_cashbox_id' => $this->faker,
            'user_id' => 1
        ];
    }
}
