<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->unique()->words($nb =3, $asText=true),
            'short_desc' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(250, 1000),
            'sale_price' => $this->faker->numberBetween(250, 1000),
            'sku' => 'DIGI' . $this->faker->unique()->numberBetween(1000,5000),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 500),
            'thumbnail' => 'digital_' . $this->faker->unique()->numberBetween(1,22) . 'jpg',
            'category_id' => $this->faker->randomNumber(1,10)
        ];
    }
}
