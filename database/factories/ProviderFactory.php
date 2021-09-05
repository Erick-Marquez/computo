<?php

namespace Database\Factories;

use App\Models\IdentificationDocument;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'document' => $this->faker->unique()->numerify('##########'),
            'comercial_name' => $this->faker->unique()->catchPhrase,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->freeEmail,
            'address' => $this->faker->address,
            'identification_document_id' => IdentificationDocument::all()->random()->id
        ];
    }
}
