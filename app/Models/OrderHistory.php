<?php

// app/Models/OrderHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_history';

    protected $fillable = [
        'customerId',
        'orderNumber',
        'product',
        'quantity',
        'subtotal',
    ];
}
