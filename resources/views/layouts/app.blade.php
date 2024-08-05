<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('page_title', 'Admin - '. config('app.name'))</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
        <script src="https://kit.fontawesome.com/ca00268a38.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
            <a class="navbar-brand w-auto pr-0" href="#">{{ config('app.name') }}</a>
            <ul class="navbar-nav align-items-center ml-auto">
                <!-- Check if the user is authenticated -->
                @auth
                    <!-- Display the authenticated user's name -->
                    <li class="nav-item mr-2">
                        Hi, <strong>{{ Auth::user()->name }}</strong>!
                    </li>

                    <!-- Logout link -->
                    <li class="nav-item mr-2">
                        <a href="#" class="nav-link btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <!-- Ensure the logout form is correctly set up with the logout route -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <!-- Optional: display a message or login link if the user is not authenticated -->
                    <li class="nav-item mr-2">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endauth
            </ul>

        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>

        @stack('scripts')
    </body>
</html>
