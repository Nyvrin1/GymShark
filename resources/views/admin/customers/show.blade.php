<!-- resources/views/admin/customers/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Customer Details</h2>
    <p><strong>Name:</strong> {{ $customer->name }}</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
    <p><strong>Address:</strong> {{ $customer->address }}</p>
    <p><strong>Registration Time:</strong> {{ $customer->created_at->format('Y-m-d H:i:s') }}</p>

    <!-- Customer Orders -->
    <h3>Orders</h3>
    @if ($customer->orders->isEmpty())
        <p>This customer has no orders.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Order Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                {{ $order->orderNumber }}
                            </a>
                        </td>
                        <td>{{ ucfirst($order->orderStatus) }}</td>
                        <td>${{ number_format($order->orderTotal, 2) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
