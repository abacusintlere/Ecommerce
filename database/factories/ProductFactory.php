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
            'name' => $this->faker->unique()->words($nb =2, $asText=true),
            'short_desc' => $this->faker->text(20),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(250, 100),
            'sale_price' => $this->faker->numberBetween(250, 100),
            'sku' => 'DIGI' . $this->faker->numberBetween(100,500),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 500),
            'thumbnail' => 'digital_' . $this->faker->numberBetween(1,22) . '.jpg',
            'category_id' => 1
        ];
    }
}
