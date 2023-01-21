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
    <form action="{{ url('kuisioner/' . $kuisioner->id) }}" method="post">
        @method('PUT')
        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0 text-center"><strong>Update Kuisioner</strong></h5>
            </div>
            <div class="card-body">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="id" value="{{$kuisioner->id}}" />
                <label>Judul Kuisioner</label></br>
                <input type="text" name="judul_kuisioner" value="{{$kuisioner->judul_kuisioner}}" id="judul_kuisioner" class="form-control"></br>
                <label>Tanggal Kirim</label></br>
                <input type="date" name="tanggal_kirim" value="{{$kuisioner->tanggal_kirim}}" id="tanggal_kirim" class="form-control"></br>
                <label>Target Angkatan</label></br>
                <select name="target_angkatan" class="form-control">
                    <option value="{{$kuisioner->target_angkatan}}" selected>{{$kuisioner->target_angkatan}}</option>
                    @foreach ($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                </select><br>
                <label>Pilih Pertanyaan</label></br>
                <select name="judul_pertanyaan" class="form-control">
                    <option value="{{$kuisioner->judul_pertanyaan}}" selected>{{$kuisioner->judul_pertanyaan}}</option>
                    @foreach ($questions as $question)
                    <option value="{{$question}}">{{$question}}</option>
                    @endforeach
                </select><br>
                <input type="submit" value="Save" class="btn btn-success"><br><br>
            </div>
        </div>
    </form>
</section>
@endsection

@section('scripts')
<script src="{{asset('js/question.js')}}"></script>
@endsection