@extends('home.layout')

@section('sidebar')
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="{{ url('/beranda') }}" class="list-group-item list-group-item-action py-2 ripple">
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
            <div id="kuisioner" class="collapse show">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ url('/kuisioner/broadcast') }}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-bullhorn fa-fw me-3"></i><span>Broadcast</span>
                    </a><br>
                    <a href="{{ url('/kuisioner/question') }}" class="list-group-item list-group-item-action py-2 ripple active">
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
    <form action="{{ url('question') }}" method="post">
        {!! csrf_field() !!}
        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0 text-center"><strong>Tambah Pertanyaan</strong></h5>
            </div>
            <div class="card-body">
                <label>Judul Pertanyaan</label></br>
                <input type="text" name="judul_pertanyaan" id="judul_pertanyaan" class="form-control"></br>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="inputFormRow">
                            <div class="input-group mb-3">
                                <input type="text" name="questions[]" class="form-control m-input" placeholder="Masukan Pertanyaan" autocomplete="off">
                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-primary">Tambah Pertanyaan</button>
                    </div>
                </div>
                <br>
                <input type="submit" value="Save" class="btn btn-success"><br><br>
                @if ($errors->any())
                <p class="text-danger">{{ $errors->first() }}</p><br>
                @endif
            </div>
        </div>
    </form>
</section>
@endsection

@section('scripts')
<script src="{{asset('js/question.js')}}"></script>
@endsection