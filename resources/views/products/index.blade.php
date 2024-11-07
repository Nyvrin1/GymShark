@extends('layouts.app')

@section('content')
    <section id="products" class="section-p1">
        <h2>Products</h2>
        <p>Explore our collection of products</p>
        <div id="product-container" class="pro-container">
            <!-- Products will be dynamically added here by JavaScript -->
        </div>
    </section>

    <script>
        // Automatically fetch products on page load
        document.addEventListener("DOMContentLoaded", fetchProducts);

        function fetchProducts() {
            fetch('http://127.0.0.1:8000/api/products')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const productContainer = document.getElementById('product-container');
                    productContainer.innerHTML = ''; // Clear existing products

                    data.forEach(product => {
                        const productElement = document.createElement('div');
                        productElement.classList.add('pro');

                        // Ensure correct string formatting for the image URL
                        const imageUrl = `http://127.0.0.1:8000/Images/${product.image}`;
                        const price = parseFloat(product.price).toFixed(2);

                        productElement.innerHTML = `
    <img src="${imageUrl}" alt="${product.name}">
    <div class="des">
        <span>${product.category}</span>
        <h5>${product.name}</h5>
        <h4>$${price}</h4>
    </div>
    <button onclick="addToCart(${product.id})" class="add-to-cart-button">
        <i class="fas fa-shopping-cart"></i>
    </button>
`;


                        productContainer.appendChild(productElement);
                    });
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });
        }

        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        // Function to add items to the cart
        function addToCart(productId) {
    if (!isLoggedIn) {
        alert('Please log in to add items to your cart.');
        window.location.href = '/login'; // Redirect to login page
        return;
    }

    // Fetch the user cart data to check the current quantity of the specific item in the cart
    fetch('http://127.0.0.1:8000/user-cart')
        .then(response => response.json())
        .then(cartData => {
            // Find the specific item in the cart by its productId
            const cartItem = cartData.find(item => item.productId === productId);
            const currentCartQuantity = cartItem ? cartItem.productQuantity : 0;

            // Fetch product data from the shop API to get the stock value
            fetch('http://127.0.0.1:8000/api/products')
                .then(response => response.json())
                .then(products => {
                    const product = products.find(p => p.id === productId);
                    if (!product) {
                        alert('Product not found.');
                        return;
                    }

                    const availableStock = product.stock;

                    // Check if adding one more item will exceed available stock
                    if (currentCartQuantity + 1 > availableStock) {
                        alert(`Cannot add more of this item. You have ${currentCartQuantity} in the cart, and only ${availableStock} are available in stock.`);
                        return; // Stop if stock is exceeded
                    }

                    // Proceed with adding to cart if within stock limits
                    fetch(`http://127.0.0.1:8000/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': '{{ csrf_token() }}' // CSRF token for Laravel
                        },
                        body: JSON.stringify({
                            quantity: 1 // Add 1 to cart
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            alert(data.message || 'Item added to cart successfully!');
                        }
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        alert('Failed to add item to cart. Please try again.');
                    });
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    alert('Failed to fetch product data. Please try again.');
                });
        })
        .catch(error => {
            console.error('Error fetching cart:', error);
            alert('Failed to check cart quantity. Please try again.');
        });
}

    </script>
@endsection
