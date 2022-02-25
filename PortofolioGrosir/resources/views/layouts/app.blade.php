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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

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
    @yield('css')
    @livewireStyles
</head>

<body id="body-pd" style="background-color: #F5F5F5;">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <header class="header shadow" id="header">

            @php
                $qty = \DB::select('select * from products where qty = 0');
            @endphp

            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="dropdown" id="notificationIcon">
                <a class="nav-item" href="#" role="button" data-bs-display="static" id="dropdownMenuLink"
                    data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class='bx bxs-bell' style="color: black"></i>
                </a>
                @if ($qty)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 12px">
                        {{ COUNT($qty) }}
                    </span>
                @endif
                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                    <div class="card">
                        <div class="card-header">
                            Notification
                        </div>
                        <div class="card-body" id="historyChart" style="height: 8rem;">
                            @forelse ($qty as $item)
                                <div class="row">
                                    <div class="col-2 me-2">
                                        <img class="pb-3"
                                            src="{{ asset('storage/public/images/' . $item->image) }}" alt=""
                                            data-holder-rendered="true" style="height: 50px; padding-top: 5px;">
                                    </div>
                                    <div class="col ms-2">
                                        <span class="d-block"
                                            style="font-size: 12px; font-weight:bold;">{{ $item->name }}</span>
                                        <span style="font-size: 12px">Stock is empty</span>
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <div class="d-flex justify-content-center">
                                    <span style="opacity: 0.5;">no notification</span>
                                </div>
                            @endforelse
                        </div>
                        <div class="card-footer text-center text-muted">
                            <a href="{{ url('/products') }}" style="color: black; opacity: 0.5;">View all
                                Notification</a>
                        </div>
                    </div>
            </div>

            </ul>
            </div>
            <div id="cashierNotif" style="color: black">{{ Auth::user()->name }} </div>
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
                    <a href="{{ url('/home') }}" class="nav_link {{ request()->is('home') ? 'active' : '' }}">
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
                    <a href="{{ url('/invoices') }}"
                        class="nav_link {{ request()->is('invoices') ? 'active' : '' }}">
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

    document.querySelectorAll('.form-outline').forEach((formOutline) => {
        new mdb.Input(formOutline).init();
    });
</script>

</html>
