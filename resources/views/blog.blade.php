@extends('layouts.app')

@section('content')
<section id="blog" class="section-p1">
    <h1>GymShark Blog</h1>
    <p>Stay updated with our latest news, fitness tips, and product releases.</p>
    <div class="container">
        <div class="card">
            <img src="{{ asset('./Images/background.jpg') }}" alt="Blog Post">
            <div class="card-content">
                <h6>Workout Routines for Beginners</h6>
                <p>Discover effective workout routines to kickstart your fitness journey.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('./Images/background.jpg') }}">
            <div class="card-content">
                <h6>Top 10 Gym Essentials</h6>
                <p>From gear to accessories, these essentials are a must-have for any gym-goer.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('./Images/background.jpg') }}">
            <div class="card-content">
                <h6>How to Stay Motivated</h6>
                <p>Learn effective tips to maintain your motivation and reach your fitness goals.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
    </div>
</section>
@endsection
