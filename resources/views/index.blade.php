<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Tracer Study</title>
    <link rel="stylesheet" href="{{url('/css/styles.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{url('/css/css2.css')}}" />
    <link rel="stylesheet" href="{{url('/css/mdb.min.css')}}" />
    <link rel="stylesheet" href="{{url('/css/admin.css')}}" />
    <script src="{{url('/js/jquery.min.js')}}" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{url('/js/Chart.min.js')}}" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light nav-bg fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars icon-color"></i>
                </button>
                <!-- Brand -->
                <a class="navbar-brand title-icon" href="/">
                    <img src="{{ asset('img/logo.svg') }}" height="25" width="28" alt="" loading="lazy" />
                    <span class="title">POLITEKNIK NEGERI MALANG</span>
                </a>

                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <li style="margin-top:2px;min-height:1px;min-width:1px;" id="gtmDC-login-button">
                        <a class="auth-modal-toggle btn btn-primary ripple-surface ms-2 me-1" style="background: white; color: #003EA4" href="{{url('/login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="{{ url('/') }}" class="list-group-item list-group-item-action py-2 ripple active">
                    <i class="fas fa-chart-column fa-fw me-3"></i><span>Statistik</span>
                </a><br>
                <a href="{{ url('/persebaran') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-map-location-dot fa-fw me-3"></i><span>Persebaran</span>
                </a><br>
            </div>
        </div>
    </nav>
    <main style="margin-top: 100px">
        <div class="container">
            <section class="mb-4">
                <div class="card">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-center"><strong>Statistik Alumni</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="myChart" height="380"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script type="text/javascript" src="{{url('/js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/js/graph.js') }}"></script>
</body>

</html>