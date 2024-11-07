<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();
        
        // Return the 'home' view and pass the products to it
        return view('home', compact('products'));
    }
}
