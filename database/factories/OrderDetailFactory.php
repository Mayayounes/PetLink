<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = \App\Models\OrderDetail::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $pricePerUnit = $this->faker->randomFloat(2, 10, 1000);

        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => $quantity,
            'price' => $quantity * $pricePerUnit,
        ];
    }
}
