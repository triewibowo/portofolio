<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="turbolinks-visit-control" content="reload">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">



    @livewireStyles
</head>

<body id="body-pd" style="background-color: #F5F5F5;">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <header class="header shadow" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div> {{ Auth::user()->name }} </div>
        </header>
    </nav>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Grosir Avicena</span>
                </a>
                <div class="nav_list">
                    <a href="{{ url('/chart') }}" class="nav_link {{ request()->is('chart') ? 'active' : '' }}">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="{{ url('/cart') }}" class="nav_link {{ request()->is('cart') ? 'active' : '' }}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Cashier</span>
                    </a>
                    <a href="{{ url('/products') }}"
                        class="nav_link {{ request()->is('products') ? 'active' : '' }}">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Product</span>
                    </a>
                    <a href="{{ url('/categories') }}"
                        class="nav_link {{ request()->is('categories') ? 'active' : '' }}">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Category</span>
                    </a>
                    <a href="{{ url('/histories') }}"
                        class="nav_link {{ request()->is('histories') ? 'active' : '' }}">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">History</span>
                    </a>
                    <a href="{{ url('/role') }}" class="nav_link {{ request()->is('role') ? 'active' : '' }}">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Stats</span>
                    </a>
                </div>
            </div>
            <div>
                <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> <i class='bx bx-log-out nav_icon'></i>
                    <span class=" nav_name">SignOut</span> </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </nav>
    </div>


    <!--Container Main start-->
    <main style="background-color: #F5F5F5;">
        <div class="container-fluid" style="height: 70px; background-color: #F5F5F5;"></div>
        @yield('content')
        {{ isset($slot) ? $slot : null }}
    </main>
    <!--Container Main end-->
    @livewireScripts
    @livewireChartsScripts
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('script-custom')
</body>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
</script>

</html>
