<?php

namespace Database\Factories;

use App\Models\BrandLine;
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
            'cod' => $this->faker->unique()->numberBetween(1000,9000),
            'description' => $this->faker->unique()->word(10),
            'price' => $this->faker->randomFloat(3, 20, 500),
            'brand_line_id' => BrandLine::all()->random()->id,
        ];
    }
}
