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
    <div class="card">
        <div class="card-header py-3">
            <h5 class="mb-0 text-center"><strong>Daftar Jawaban</strong></h5>
        </div>
        <div class="card-body">
            @if (isset($error))
            <p class="text-center mb-0">{{$error}}</p>
            @else
            <label>No Jawaban</label></br>
            <select id="answer_id" name="answer_id" class="form-control">
                <option hidden>Pilih Jawaban</option>
                @foreach ($answers_id as $answer_id)
                <option value="{{$answer_id}}">{{$loop->iteration}}</option>
                @endforeach
            </select>
            <br>
            <a id="link" href=''><button type="button" class="btn btn-primary">Submit</button></a><br>
            <br>
            <div class="row">
                <div class="col-md-7 mb-4">
                    <table class="table table-borderless">
                        <tr>
                            <td><p class="fw-bold mb-1">Nama</p></td>
                            <td>{{$alumni->name}}</td>
                        </tr>
                        <tr>
                            <td><p class="fw-bold mb-1">Nomor Induk Mahasiswa</p></td>
                            <td>{{$alumni->nim}}</td>
                        </tr>
                        <tr>
                            <td><p class="fw-bold mb-1">Program Studi</p></td>
                            <td>{{$alumni->prodi}}</td>
                        </tr>
                        <tr>
                            <td><p class="fw-bold mb-1">Tahun Angkatan</p></td>
                            <td>{{$alumni->angkatan}}</td>
                        </tr>
                        <tr>
                            <td><p class="fw-bold mb-1">Jenis Kelamin</p></td>
                            <td>{{$alumni->jenis_kelamin}}</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="col-md-7 mb-4">
                    @foreach ($questions as $question)
                    <p class="fw-bold mb-1">{{$question['pertanyaan']}}</p>
                    <p>{{$question['jawaban']}}</p>
                    @endforeach
                </div>
            </div>
            @endif
            <a class="btn btn-success" href="{{ url()->previous() }}" role="button">Kembali</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#answer_id").on('change', function() {
            var answer = document.getElementById("answer_id").value;
            $('#link').attr('href', window.location.href.split('?')[0] + '?answer_id=' + answer);
        });
    });
</script>
@endsection