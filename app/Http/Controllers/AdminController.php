<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        // Check if the user is already logged in and is not an admin
        if (Auth::check() && !Auth::user()->isAdmin) {
            // Log out the user directly in this method if they are not an admin
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'login' => 'You have been logged out. Admin access is required.'
            ]);
        }

        // Show the admin login form if not logged in or if the user is an admin
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['isAdmin'] = 1;

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->route('admin.login')->withErrors(['login' => 'Unauthorized: Admin access required']);
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // Create this view
    }

    public function showCreateProductForm()
    {
        return view('admin.create_product'); // Create this view
    }

    // Handle form submission to create a new product
    public function createProduct(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|string|max:255', // Now a string, only storing image name
            'category' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);
    
        // Store only the image name from the input (assuming the image name is provided directly)
        // $validatedData['image'] already contains the image name, so no additional processing is required.
    
        // Create the product
        Product::create($validatedData);
    
        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully!');
    }

    public function showUpdateProductForm(Request $request)
    {
        // Fetch products to display options for selection
        $products = Product::all();
        return view('admin.edit_product', compact('products'));
    }

    // Handle the form submission to update the product
    public function updateProduct(Request $request, $id)
    {
        // Validate the data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);

        // Find and update the product
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.dashboard')->withErrors(['error' => 'Product not found.']);
        }

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    public function listOrders(Request $request)
    {
        $query = Order::with('customer'); // Load customer data for each order

        // Search by order number if provided
        if ($request->has('order_number') && $request->order_number) {
            $query->where('orderNumber', 'like', '%' . $request->order_number . '%');
        }

        $orders = $query->paginate(10); // Paginate the results

        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'orderStatus' => 'required|string|max:255',
        ]);

        $order->update(['orderStatus' => $validatedData['orderStatus']]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully!');
    }

    public function getOrderDetails($id)
    {
        // Retrieve the order along with customer and order items
        $order = Order::with(['customer', 'orderItems.product'])->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Format the response data
        $orderData = [
            'orderNumber' => $order->orderNumber,
            'customer' => [
                'name' => $order->customer->name,
                'email' => $order->customer->email,
                'phone' => $order->customer->phone,
                'address' => $order->customer->address,
            ],
            'orderStatus' => $order->orderStatus,
            'orderTotal' => number_format($order->orderTotal, 2),
            'orderDate' => $order->orderDate->format('Y-m-d H:i:s'),
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'product' => $item->product->name,
                    'quantity' => $item->productQuantity,
                    'subtotal' => number_format($item->productSubtotal, 2),
                ];
            })
        ];

        return response()->json($orderData);
    }

    public function showOrderDetails($id)
    {
        // Fetch the order with customer information
        $order = Order::with('customer')->findOrFail($id);
        
        // Fetch the items from OrderHistory associated with this order
        $orderHistoryItems = OrderHistory::where('orderNumber', $order->orderNumber)->get();
    
        // Pass both the order and order history items to the view
        return view('admin.orders.show', compact('order', 'orderHistoryItems'));
    }

    public function showCustomerDetails($id)
    {
        // Fetch customer data by ID
        $customer = Customer::with('orders')->findOrFail($id);
    
        return view('admin.customers.show', compact('customer'));
    }    

    public function listCustomers()
    {
        // Retrieve all customers with pagination
        $customers = Customer::paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

}

