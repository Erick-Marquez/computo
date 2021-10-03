<?php

namespace Database\Factories;

use App\Models\IdentificationDocument;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'document' => $this->faker->unique()->numerify('###########'),
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->freeEmail,
            'address' => $this->faker->address,
            'identification_document_id' => IdentificationDocument::all()->random()->id
        ];
    }
}
