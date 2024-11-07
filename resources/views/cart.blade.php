@extends('layouts.app')

@section('content')
<section id="cart" class="section-p1">
    <h1>Your Shopping Cart</h1>
    <p>Your selected items will appear here.</p>

    <div id="cart-items">
        @php $orderTotal = 0; @endphp
        @foreach($orders as $orderItem)
            @php
                $subtotal = $orderItem->productQuantity * $orderItem->productPrice;
                $orderTotal += $subtotal;
            @endphp
            <div class="cart-item">
                <div class="cart-item-image">
                    <img src="{{ asset('Images/' . $orderItem->product->image) }}" alt="{{ $orderItem->product->name }}">
                </div>
                <div class="cart-item-details">
                    <h5>{{ $orderItem->product->name }}</h5>
                    <p>Price: ${{ number_format($orderItem->productPrice, 2) }}</p>
                    <p>Quantity: {{ $orderItem->productQuantity }}</p>
                    <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
                    <div class="quantity-controls">
                        <button onclick="updateQuantity({{ $orderItem->product->id }}, -1)">-</button>
                        <span>{{ $orderItem->productQuantity }}</span>
                        <button onclick="updateQuantity({{ $orderItem->product->id }}, 1)">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="order-summary">
        <h3>Order Total: ${{ number_format($orderTotal, 2) }}</h3>
        <button onclick="checkout()" class="checkout-button">Checkout</button>
    </div>
</section>

<script>
    const csrfToken = "{{ csrf_token() }}";

    function updateQuantity(productId, change) {
        let url = change > 0 
            ? `http://127.0.0.1:8000/cart/increase/${productId}`
            : `http://127.0.0.1:8000/cart/decrease/${productId}`;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error updating cart:', error);
        });
    }

    function checkout() {
    fetch('http://127.0.0.1:8000/cart/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // If there is an error (like insufficient stock), show an alert with the error message
                alert(`Checkout failed: ${data.error}`);
            } else {
                // If checkout is successful, show a success message and reload the page
                alert(data.message || 'Order completed successfully!');
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error during checkout:', error);
            alert('An unexpected error occurred during checkout. Please try again.');
        });
    }

</script>
@endsection
