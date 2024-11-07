@extends('layouts.app')

@section('content')
<section id="login" class="form-section">
    <h2>Login</h2>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</section>
@endsection
