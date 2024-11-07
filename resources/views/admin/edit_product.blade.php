@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Update Product</h2>

    <!-- Form to select a product to edit -->
    <form id="productSelectForm" class="mb-4">
        <label for="product" class="form-label">Select Product:</label>
        <select id="product" name="product" class="form-select" onchange="loadProductData(this.value)">
            <option value="">-- Choose a Product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </form>

    <!-- Product Update Form -->
    <form id="updateProductForm" action="{{ route('admin.products.updateProduct', ['id' => '__id__']) }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" id="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Save Changes</button>
    </form>

    <!-- Delete Product Form -->
    <form id="deleteProductForm" action="{{ route('admin.products.delete', ['id' => '__id__']) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this product?')">
            Delete Product
        </button>
    </form>

    <!-- Navigation Buttons -->
    <div class="mt-4">
        <a href="{{ route('admin.products.create') }}" class="btn btn-secondary me-2">Back to Create Product</a>
        <a href="{{ route('admin.orders') }}" class="btn btn-info">Go to Manage Orders</a>
    </div>
</div>

<script>
// JavaScript to dynamically load selected product data into form fields
function loadProductData(productId) {
    if (!productId) return;
    fetch(`/api/products/${productId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('description').value = data.description;
            document.getElementById('price').value = data.price;
            document.getElementById('stock').value = data.stock;
            document.getElementById('image').value = data.image;
            document.getElementById('category').value = data.category;
            document.getElementById('status').value = data.status;

            // Update the form action URLs to include the product ID
            document.getElementById('updateProductForm').action = `/admin/products/update/${productId}`;
            document.getElementById('deleteProductForm').action = `/admin/products/delete/${productId}`;
        });
}
</script>
@endsection
