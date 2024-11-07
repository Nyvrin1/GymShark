<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Add an item to the cart
    public function addToCart(Request $request, $product_id)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $customerId = Auth::id();
            $product = Product::findOrFail($product_id);

            if ($product->stock < $request->quantity) {
                return response()->json(['error' => 'Product not available in requested quantity'], 400);
            }

            $order = Order::getOrCreateCart($customerId);

            $orderItem = $order->orderItems()->firstOrCreate(
                [
                    'orderId' => $order->id,
                    'productId' => $product_id,
                ],
                [
                    'productName' => $product->name,
                    'productPrice' => $product->price,
                    'productQuantity' => 0,
                    'productSubtotal' => 0,
                ]
            );

            $orderItem->productQuantity += $request->quantity;
            $orderItem->productSubtotal = $orderItem->productQuantity * $product->price;
            $orderItem->save();

            $order->orderTotal = $order->orderItems->sum('productSubtotal');
            $order->save();

            return response()->json(['message' => 'Item added to cart successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while adding to the cart.'], 500);
        }
    }

    // Increase quantity
    public function increaseQuantity($product_id)
    {
        $customerId = Auth::id();
        $order = Order::where('customerId', $customerId)->where('orderStatus', 'pending')->firstOrFail();
        $orderItem = $order->orderItems()->where('productId', $product_id)->first();

        if (!$orderItem) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        $product = Product::findOrFail($product_id);
        if ($orderItem->productQuantity + 1 > $product->stock) {
            return response()->json(['error' => 'Requested quantity exceeds stock'], 400);
        }

        $orderItem->productQuantity += 1;
        $orderItem->productSubtotal = $orderItem->productQuantity * $product->price;
        $orderItem->save();

        $order->orderTotal = $order->orderItems->sum('productSubtotal');
        $order->save();

        return response()->json(['message' => 'Quantity increased', 'orderTotal' => $order->orderTotal]);
    }

    // Decrease quantity
    public function decreaseQuantity($product_id)
    {
        $customerId = Auth::id();
        $order = Order::where('customerId', $customerId)->where('orderStatus', 'pending')->firstOrFail();
        $orderItem = $order->orderItems()->where('productId', $product_id)->first();

        if (!$orderItem) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        if ($orderItem->productQuantity > 1) {
            $orderItem->productQuantity -= 1;
            $orderItem->productSubtotal = $orderItem->productQuantity * $orderItem->productPrice;
            $orderItem->save();
        } else {
            $orderItem->delete();
        }

        $order->orderTotal = $order->orderItems->sum('productSubtotal');
        $order->save();

        return response()->json(['message' => 'Quantity decreased', 'orderTotal' => $order->orderTotal]);
    }

    // Checkout
    public function checkout()
    {
        $customerId = Auth::id();
        $order = Order::where('customerId', $customerId)->where('orderStatus', 'pending')->firstOrFail();
    
        // Check if the cart is empty
        if ($order->orderItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty. Please add items before checking out.'], 400);
        }
    
        // Verify stock availability for each item in the cart
        foreach ($order->orderItems as $orderItem) {
            $product = Product::find($orderItem->productId);
    
            if (!$product) {
                return response()->json(['error' => 'One of the products is not available.'], 400);
            }
    
            if ($product->stock < $orderItem->productQuantity) {
                return response()->json([
                    'error' => "Insufficient stock for {$product->name}. Available: {$product->stock}, Required: {$orderItem->productQuantity}"
                ], 400);
            }
        }
    
        // Log each order item to OrderHistory
        foreach ($order->orderItems as $orderItem) {
            OrderHistory::create([
                'customerId' => $customerId,
                'orderNumber' => $order->orderNumber,
                'product' => $orderItem->product->name,
                'quantity' => $orderItem->productQuantity,
                'subtotal' => $orderItem->productSubtotal,
            ]);
        }
    
        // Deduct stock for each item in the cart
        foreach ($order->orderItems as $orderItem) {
            $product = Product::find($orderItem->productId);
            $product->stock -= $orderItem->productQuantity;
            $product->save();
        }
    
        // Complete the order
        $order->orderStatus = 'completed';
        $order->orderDate = now();
        $order->save();
    
        // Clear the cart by deleting the pending items
        $order->orderItems()->delete();
    
        return response()->json(['message' => 'Order completed successfully!']);
    }
    

    // Show cart items
    public function showCart()
    {
        $customerId = Auth::id();
        $order = Order::where('customerId', $customerId)
                      ->where('orderStatus', 'pending')
                      ->with('orderItems.product')
                      ->first();

        $orders = $order ? $order->orderItems : collect();

        return view('cart', compact('orders'));
    }
}
