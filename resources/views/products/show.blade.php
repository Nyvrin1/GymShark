@extends('layouts.app')

@section('content')
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="{{ asset('Images/' . $product->image) }}" width="100%" id="MainImg">
            <!-- Thumbnail images from the product, if any -->
        </div>
        <div class="single-pro-details">
            <h6>{{ $product->category }}</h6>
            <h4>{{ $product->name }}</h4>
            <h2>${{ $product->price }}</h2>
            <select>
                <option>Select Size</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
            </select>
            <input type="number" value="1">
            <button class="normal">Add To Cart</button>
            <h4>Product details</h4>
            <span>{{ $product->description }}</span>
        </div>
    </section>
@endsection
