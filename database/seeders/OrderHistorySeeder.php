<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderItem;

class OrderHistorySeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
                OrderHistory::create([
                    'customerId' => $order->customerId,
                    'orderNumber' => $order->orderNumber,
                    'product' => $item->productName,
                    'quantity' => $item->productQuantity,
                    'subtotal' => $item->productSubtotal,
                ]);
            }
        }
    }
}
