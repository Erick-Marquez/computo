<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod' => $this->faker->numerify('#####'),
            'name' => $this->faker->word(15),
            'description' => $this->faker->word(20),
            'igv_type_id' => 8,
            'referential_sale_price' => $this->faker->randomFloat(3, 20, 500),
            'referential_sale_price_one' => $this->faker->randomFloat(3, 20, 500),
            'referential_sale_price_two' => $this->faker->randomFloat(3, 20, 500),
            'brand_id' => Brand::all()->random()->id,
            'line_id' => Line::all()->random()->id,
        ];
    }
}
