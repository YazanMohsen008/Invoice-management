<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "invoice_id" => $this->faker->numberBetween(100, 1000),
            "product_id" => $this->faker->numberBetween(10, 100),
            "unit_price" => $this->faker->numberBetween(100, 5000),
            "quantity" => $this->faker->numberBetween(1, 5),
        ];
    }
}
