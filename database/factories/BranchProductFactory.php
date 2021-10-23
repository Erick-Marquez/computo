<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\IgvType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BranchProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stock' => $this->faker->numerify('##'),
            'igv_type_id' => 8,
            'sale_price' => $this->faker->randomFloat(3, 20, 500),
            'referential_sale_price_one' => $this->faker->randomFloat(3, 20, 500),
            'referential_sale_price_two' => $this->faker->randomFloat(3, 20, 500),
            'product_id' => Product::all()->random()->id,
            'branch_id' => Branch::all()->random()->id
        ];
    }
}
