@extends('layouts.app')

@section('content')
<section id="contact" class="section-p1">
    <h1>Contact Us</h1>
    <p>We'd love to hear from you! Please reach out to us for any questions or feedback.</p>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="normal">Submit</button>
    </form>
    
</section>
@endsection
