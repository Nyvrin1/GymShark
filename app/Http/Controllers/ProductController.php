<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display all products in a view
    public function index()
    {
        $products = Product::all();
        $isAuthenticated = auth()->check(); // Check if the user is logged in
        return view('products.index', compact('isAuthenticated'));
        return view('products.index', compact('products'));
    }

    // API endpoint to display all products as JSON
    public function indexApi()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Display a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('shop');
    }

    // Show form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Update a specific product in the database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('shop');
    }

    // Delete a specific product from the database
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('shop');
    }

    // Method to get a specific product by ID
    public function getProductById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
}




