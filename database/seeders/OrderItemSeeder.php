<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            // Add a few items per order, linking to different products
            foreach ($products->random(3) as $product) {
                OrderItem::create([
                    'orderId' => $order->id,
                    'productId' => $product->id,
                    'productName' => $product->name,
                    'productPrice' => $product->price,
                    'productQuantity' => rand(1, 5),  // Random quantity between 1-5
                    'productSubtotal' => $product->price * rand(1, 5),
                ]);
            }
        }
    }
}
