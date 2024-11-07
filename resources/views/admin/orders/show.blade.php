@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order Details - {{ $order->orderNumber }}</h2>
    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
    <p><strong>Email:</strong> {{ $order->customer->email }}</p>
    <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
    <p><strong>Address:</strong> {{ $order->customer->address }}</p>
    <p><strong>Status:</strong> {{ $order->orderStatus }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->orderTotal, 2) }}</p>
    <p><strong>Date:</strong> {{ $order->orderDate }}</p>

    <!-- Order Items -->
    <h3>Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderHistoryItems as $item)
                <tr>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Update Order Status -->
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="orderStatus">Update Status</label>
            <select name="orderStatus" class="form-control">
                <option value="pending" {{ $order->orderStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->orderStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="shipped" {{ $order->orderStatus == 'shipped' ? 'selected' : '' }}>Shipped</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Status</button>
    </form>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
</div>
@endsection
