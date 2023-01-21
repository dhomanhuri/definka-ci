@extends('home.layout')

@section('sidebar')
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="{{ url('/beranda') }}" class="list-group-item list-group-item-action py-2 ripple active">
                <i class="fas fa-house fa-fw me-3"></i><span>Beranda</span>
            </a><br>
            <a href="{{ url('/data') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-solid fa-list fa-fw me-3"></i><span>Data</span>
            </a><br>
            @if (session()->get('role') == "Admin")
            <a href="{{ url('/akun') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-solid fa-users fa-fw me-3"></i><span>Akun</span>
            </a><br>
            <button class="list-group-item list-group-item-action py-2 ripple" data-bs-toggle="collapse" data-bs-target="#kuisioner" aria-expanded="false" aria-controls="kuisioner">
                <i class="fas fa-solid fa-clipboard-list fa-fw me-3"></i><span>Kuisioner</span>
            </button>
            <div id="kuisioner" class="collapse">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ url('/kuisioner/broadcast') }}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-bullhorn fa-fw me-3"></i><span>Broadcast</span>
                    </a><br>
                    <a href="{{ url('/kuisioner/question') }}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-circle-question fa-fw me-3"></i><span>Pertanyaan</span>
                    </a>
                </div>
            </div>
            @endif
            <br>
            <a href="{{ url('/persebaran-data') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-map-location-dot fa-fw me-3"></i><span>Persebaran</span>
            </a><br>
        </div>
    </div>
</nav>
@endsection

@section('content')
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
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/graph.js') }}"></script>
@endsection