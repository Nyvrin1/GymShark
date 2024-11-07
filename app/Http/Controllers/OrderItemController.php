<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    // Show items in the user's cart
    public function userCart()
    {
        // Ensure the user is authenticated
        $customerId = Auth::id();
    
        if (!$customerId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Get the pending cart items for this user
        $cartItems = OrderItem::whereHas('order', function ($query) use ($customerId) {
            $query->where('customerId', $customerId)->where('orderStatus', 'pending');
        })->with('product')->get();
    
        return response()->json($cartItems);
    }
    

    // Store an Order Item - This may be used if you need direct control over OrderItems
    public function store(Request $request)
    {
        $request->validate([
            'orderId' => 'required|exists:orders,id',
            'productId' => 'required|exists:products,id',
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric|min:0',
            'productQuantity' => 'required|integer|min:1',
            'productSubtotal' => 'required|numeric|min:0',
        ]);

        OrderItem::create($request->all());
        return redirect()->route('orders.show', $request->orderId);
    }
}
