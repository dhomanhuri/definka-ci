<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Tracer Study</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('css/css2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/admin.css')}}" />
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/Chart.min.js')}}" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        @yield('sidebar')
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light nav-bg fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars icon-color"></i>
                </button>
                <a class="navbar-brand title-icon" href="/">
                    <img src="{{ asset('img/logo.svg') }}" height="25" width="28" alt="" loading="lazy" />
                    <span class="title">POLITEKNIK NEGERI MALANG</span>
                </a>

                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-solid fa-circle-user fa-fw me-3 fa-2xl icon-color"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            @if (session()->get('role') == "Admin")
                            <li><a class="dropdown-item" href="{{ url('/akun/' . session()->get('id')) }}">My profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/akun/' . session()->get('id')) . '/edit' }}">Settings</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main style="margin-top: 58px">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    @yield('scripts')
</body>
</html>