<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerId',
        'orderStatus',
        'orderTotal',
        'orderDate',
        'orderNumber',
    ];

    // Method to get or create a cart for the specified customer
    public static function getOrCreateCart($customerId)
    {
        return self::firstOrCreate(
            ['customerId' => $customerId, 'orderStatus' => 'pending'],
            [
                'orderTotal' => 0.00,
                'orderDate' => now(),
                'orderNumber' => 'ORD-' . strtoupper(uniqid()), // Generate a unique order number
            ]
        );
    }    
    
    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }

    // Define the relationship with OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderId');
    }
}
