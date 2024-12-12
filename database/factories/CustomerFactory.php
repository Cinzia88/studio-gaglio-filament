<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'nome' => $this->faker->name(),
                'cognome' => $this->faker->lastname(),
                'telefono' => $this->faker->phoneNumber(),
                'email' =>  $this->faker->unique()->safeEmail(),
                'password' => $this->faker->password(),


        ];
    }
}
