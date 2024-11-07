@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Create New Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Create Product</button>
    </form>

    <!-- Navigation Button -->
    <div class="mt-4">
        <a href="{{ route('admin.products.update') }}" class="btn btn-secondary">Go to Update Product</a>
    </div>
</div>
@endsection
