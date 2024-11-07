<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::where('isAdmin', 0)->get();

        foreach ($customers as $customer) {
            Order::create([
                'customerId' => $customer->id,
                'orderStatus' => 'completed',
                'orderTotal' => 100.00,  // Use any sample total
                'orderDate' => now(),
                'orderNumber' => 'ORD-' . strtoupper(Str::random(8)),
            ]);
        }
    }
}
