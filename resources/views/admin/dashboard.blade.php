@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Welcome to the Admin Dashboard</h1>
    <p class="text-center mb-4">Manage orders, products, users, and more from here.</p>

    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <a href="{{ route('admin.products.create') }}" class="dashboard-link">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Create New Product</h5>
                        <p class="card-text">Add new products to the store.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('admin.products.update') }}" class="dashboard-link">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Update Product</h5>
                        <p class="card-text">Edit existing products in the store.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('admin.orders') }}" class="dashboard-link">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Manage Orders</h5>
                        <p class="card-text">View and update orders.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('admin.customers.index') }}" class="dashboard-link">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Manage Customers</h5>
                        <p class="card-text">View customer data and history.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
