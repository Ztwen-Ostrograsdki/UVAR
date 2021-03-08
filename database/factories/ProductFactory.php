<?php

namespace Database\Factories;

use App\Models\Model;
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
        $prices = [1000.00, 50000.00, 45700.00, 20000.00, 90000.00, 75000.00];
        return [
            'name' => $this->faker->sentence(2, 4),
            'description' => $this->faker->sentence(1, 4),
            'total' => rand(4, 100),
            'price' => $prices[rand(0, 5)],
        ];
    }
}
