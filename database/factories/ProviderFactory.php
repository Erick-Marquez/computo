<?php

namespace Database\Factories;

use App\Models\IdentificationDocument;
use App\Models\Provider;
use App\Models\Ubigee;
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
            'tradename' => $this->faker->unique()->catchPhrase,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->freeEmail,
            'address' => $this->faker->address,
            'identification_document_id' => IdentificationDocument::all()->random()->id,
            'ubigee_id' => Ubigee::all()->random()->id
        ];
    }
}
