<!-- START HEADER -->
<header class="header_wrap fixed-top dd_dark_skin transparent_header">
    <div class="main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <!-- Logo -->
                <a href="{{ URL('/') }}" class="navbar-brand">
                    <img src="{{ asset('img/bee.jpg') }}" alt="Logo" class="logo-img">
                </a>
                
                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/') }}">@lang('menu.home')</a>
                        </li>

                        <!-- Products -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('/products') }}">@lang('menu.products')</a>
                        </li>

                        <!-- Contact -->
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">@lang('menu.contact')</a>
                        </li>

                        <!-- User Authentication -->
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('profile_images/' . Auth::user()->profile_image) }}" alt="@lang('menu.profile_image', ['name' => Auth::user()->name])" class="rounded-circle profile-img">
                                        @lang('menu.hello') {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ url('/admin') }}">@lang('Mi cuenta')</a>
                                        <a class="dropdown-item" href="{{ URL('logout') }}">@lang('menu.logout')</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">@lang('menu.login')</a>
                                </li>
                                <!-- Uncomment if registration is enabled -->
                                <!-- 
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">@lang('menu.register')</a>
                                </li>
                                -->
                            @endauth
                        @endif

                        <!-- Language Switcher -->
                        <!-- Uncomment if needed
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('setLanguage/es')}}">&#127474;&#127485;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('setLanguage/en')}}">&#x1F1FA;&#x1F1F8;</a>
                        </li>
                        -->
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- END HEADER -->

<style>

    /* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

.header_wrap {
    background-color: #002366; /* Azul rey */
    border-bottom: 4px solid #FFD700; /* Amarillo */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.header_wrap:hover {
    background-color: #001944; /* Darker Azul rey */
}

.main_menu_uppercase {
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Logo Styles */
.logo-img {
    width: 300px;
    height: auto;
    padding-bottom: 10px;
    transition: transform 0.3s ease, filter 0.3s ease;
}

.logo-img:hover {
    transform: scale(1.1);
    filter: brightness(1.2);
}

/* Navbar Styles */
.navbar-dark .navbar-nav .nav-link {
    color: #ffffff;
    padding: 15px 20px;
    transition: color 0.3s ease, background-color 0.3s ease;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}

.navbar-dark .navbar-nav .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background-color: #FFD700; /* Amarillo */
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
}

.navbar-dark .navbar-nav .nav-link:hover::before {
    transform: scaleX(1);
    transform-origin: left;
}

.navbar-dark .navbar-nav .nav-link.active,
.navbar-dark .navbar-nav .nav-link:hover {
    color: #002366;

    border-radius: 20px;
}

.navbar-toggler {
    border-color: #FFD700; /* Amarillo */
    transition: transform 0.3s ease;
}

.navbar-toggler:hover {
    transform: rotate(90deg);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 215, 0, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

/* Dropdown Styles */
.dropdown-menu {
    background-color: #f4f4f9;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, opacity 0.3s ease;
    transform: translateY(-10px);
    opacity: 0;
}

.nav-item.dropdown:hover .dropdown-menu {
    transform: translateY(0);
    opacity: 1;
}

.dropdown-item {
    color: #333;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #FFD700;
    color: #002366;
}

/* Profile Image */
.profile-img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
    border: 2px solid #FFD700;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.profile-img:hover {
    transform: scale(1.1);
}

</style>