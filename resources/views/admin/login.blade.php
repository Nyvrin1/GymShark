<!-- resources/views/admin/login.blade.php -->

@extends('layouts.app')

@section('content')
<div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        @if ($errors->has('login'))
            <p class="error">{{ $errors->first('login') }}</p>
        @endif
        <button type="submit">Login</button>
    </form>
</div>
@endsection
