<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers'; // Specify the correct table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'isAdmin'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Define the relationship with Order model
    public function orders()
    {
        return $this->hasMany(Order::class, 'customerId');
    }
}
