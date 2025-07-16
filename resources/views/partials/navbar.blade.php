<nav>
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        QUEST4KNOWLEDGE
    </div>
    <div class="nav-links">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/') }}#pricing">Pricing</a>
        <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/tutor-application') }}">Become a Tutor</a>
        <a href="{{ url('/learning-portal') }}" target="_blank">Learning Portal</a>
    </div>
    <div class="auth-links">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
        <a href="{{ url('/') }}#request" class="cta-nav">REQUEST A TUTOR</a>
    </div>
    <button class="mobile-menu-btn">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}#about">About</a></li>
        <li><a href="{{ url('/') }}#services">Services</a></li>
        <li><a href="{{ url('/') }}#pricing">Pricing</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
        <li><a href="{{ url('/tutor-application') }}">Become a Tutor</a></li>
        <li><a href="{{ url('/learning-portal') }}" target="_blank">Learning Portal</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
        @endif
        <li><a href="{{ url('/') }}#request" class="cta-nav" style="display: inline-block; margin-top: 20px;">REQUEST A TUTOR</a></li>
    </ul>
</div> 