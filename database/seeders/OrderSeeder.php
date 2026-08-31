<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();

        Order::factory()
            ->count(10)
            ->make()
            ->each(function (Order $order) use ($customers, $products) {

                $customer = $customers->random();

                $order->customer_id = $customer->id;
                $order->save();

                $selectedProducts = $products->random(
                    fake()->numberBetween(1, 4)
                );

                foreach ($selectedProducts as $product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => fake()->numberBetween(1, 5),
                        'unit_price' => $product->unit_price,
                    ]);
                }
            });
    }
}
