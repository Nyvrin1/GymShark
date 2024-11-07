@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Order Management</h2>

    <!-- Search Form -->
    <form action="{{ route('admin.orders') }}" method="GET" class="d-flex mb-4">
        <input type="text" name="order_number" placeholder="Search by Order Number" value="{{ request('order_number') }}" class="form-control me-2">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Orders List -->
    <table class="table table-striped table-hover shadow-sm rounded">
        <thead class="table-dark text-center">
            <tr>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="text-center">
                    <td>{{ $order->orderNumber }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>${{ number_format($order->orderTotal, 2) }}</td>
                    <td>{{ ucfirst($order->orderStatus) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Orders pagination">
            <ul class="pagination">
                @if ($orders->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span> Previous
                        </a>
                    </li>
                @endif

                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($orders->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                            Next <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.products.update') }}" class="btn btn-secondary">Back to Update Product</a>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-info">Go to Customer Management</a>
    </div>
</div>
@endsection
