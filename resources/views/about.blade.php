@extends('layouts.app')

@section('content')


    <!-- Newsletter Section -->
    <section id="newsettler" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up Now!</h4>
            <p>Get Email Updates On Our Latest Offers And <span>New Items</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your Email Address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

   
@endsection

@section('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
