@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Customer Management</h2>

    <!-- Customers List -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>
                        <!-- Make the name a clickable link -->
                        <a href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}</a>
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>

    <!-- Navigation Button -->
    <div class="mt-4">
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Back to Orders List</a>
    </div>
</div>
@endsection
