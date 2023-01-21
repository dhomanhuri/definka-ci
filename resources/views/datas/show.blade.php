@extends('home.layout')

@section('sidebar')
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <a href="{{ url('/beranda') }}" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-house fa-fw me-3"></i><span>Beranda</span>
      </a><br>
      <a href="{{ url('/data') }}" class="list-group-item list-group-item-action py-2 ripple active">
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
      <h5 class="mb-0 text-center"><strong>Lihat Data Alumni</strong></h5>
    </div>
    <div class="card-body">
      <input type="hidden" name="id" id="id" value="{{$alumni->id}}" id="id" disabled />
      <label>Nama</label></br>
      <input type="text" name="name" id="name" value="{{$alumni->name}}" class="form-control" disabled></br>
      <label>Nomor Induk Mahasiswa</label></br>
      <input type="text" name="nim" id="nim" value="{{$alumni->nim}}" class="form-control" disabled></br>
      <label>Angkatan</label></br>
      <input type="text" name="angkatan" id="angkatan" value="{{$alumni->angkatan}}" class="form-control" disabled></br>
      <label>Program Studi</label></br>
      <input type="text" name="prodi" id="prodi" class="form-control" value="{{$alumni->prodi}}" disabled></br>
      <label>Nomor Telepon</label></br>
      <input type="text" name="telepon" id="telepon" class="form-control" value="{{$alumni->telepon}}" disabled></br>
      <label>Jenis Kelamin</label></br>
      <select class="form-control" name="jenis_kelamin" disabled>
        <option {{ old('jenis_kelamin', $alumni->jenis_kelamin) == "Laki-Laki"? 'selected':''}} value="Laki-Laki">Laki-Laki</option>
        <option {{ old('jenis_kelamin', $alumni->jenis_kelamin) == "Perempuan"? 'selected':''}} value="Perempuan">Perempuan</option>
      </select></br>
      <label>Pekerjaan</label></br>
      <select class="form-control" name="pekerjaan" disabled>
        <option {{ old('pekerjaan', $alumni->pekerjaan) == "Bekerja"? 'selected':''}} value="Bekerja">Bekerja</option>
        <option {{ old('pekerjaan', $alumni->pekerjaan) == "Berwirausaha"? 'selected':''}} value="Berwirausaha">Berwirausaha</option>
      </select><br>
      <label>Tempat Kerja</label></br>
      <select class="form-control" name="tempat_kerja" disabled>
        <option value="{{ $alumni->tempat_kerja }}" selected>{{ $alumni->tempat_kerja }}</option>
      </select><br>
      <a class="btn btn-success" href="{{ url('/data') }}" role="button">Kembali</a>
    </div>
    </hr>
  </div>
  </div>
</section>
@endsection