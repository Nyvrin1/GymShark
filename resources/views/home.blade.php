@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero">
        <h2>NEW SEASON</h2>
        <h6>NEW STYLES AND SHADES TO GO GYM IN</h6>
        <p>In a world where you can do anything, do gym. And do it in these fresh new styles and shades made to help you get after your goals</p>
        <button onclick="window.location.href='{{ route('shop') }}'">Shop Now</button>
    </section>

    <!-- Features Section -->
    <section id="features" class="container">
        <div class="card">
            <img src="{{ asset('Images/delivery.png') }}" alt="Free Shipping">
            <div class="card-content"><h6>Free Shipping</h6></div>
        </div>
        <div class="card">
            <img src="{{ asset('Images/clock.jpg') }}" alt="Online Order">
            <div class="card-content"><h6>Online Order</h6></div>
        </div>
        <div class="card">
            <img src="{{ asset('Images/save2.png') }}" alt="Save Money">
            <div class="card-content"><h6>Save Money</h6></div>
        </div>
        <div class="card">
            <img src="{{ asset('Images/Promo.png') }}" alt="Promotions">
            <div class="card-content"><h6>Promotions</h6></div>
        </div>
        <div class="card">
            <img src="{{ asset('Images/Support.jfif') }}" alt="24/7 Support">
            <div class="card-content"><h6>24/7 Support</h6></div>
        </div>
    </section>

    
@endsection
