<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'total_price' => fake()->randomFloat(2,0,100),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $products = Product::inRandomOrder()->take(rand(1, 10))->get();

            foreach ($products as $product) {
                $quantity = random_int(1, 5);
                $order->products()->attach($product->id, ['quantity' => $quantity]);
            }

            $order->updateTotalPrice();
        });
    }
}
