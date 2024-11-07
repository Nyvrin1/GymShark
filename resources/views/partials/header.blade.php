<section id="header">
    <a href="#"><img src="/Images/gymshark-logo-design-history-and-evolution-kreafolk_c1b75610-5b58-4a4d-bdb6-0d51ac45315b.jpg" class="logo" alt="GymShark Logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>

            @auth
                @if(Auth::user()->isAdmin)
                    <!-- Admin Dropdown Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            Admin <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.products.create') }}">Create Product</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.products.update') }}">Update Products</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.orders') }}">Manage Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.customers.index') }}">Customer Management</a></li>
                            <!-- Add other admin routes as needed -->
                        </ul>
                    </li>
                @endif
            @endauth

            @guest
                <!-- Show login/register links if the user is not authenticated -->
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endguest

            @auth
                <!-- Show logout option if the user is authenticated -->
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </li>
            @endauth

            <li id="lg-bag"><a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <a href="#" id="close"><i class="fa-solid fa-x"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
