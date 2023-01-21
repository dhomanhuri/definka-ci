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
      <h5 class="mb-0 text-center"><strong>Tambah Data Alumni</strong></h5>
    </div>
    <div class="card-body">

      <form action="{{ url('data') }}" method="post">
        {!! csrf_field() !!}
        <label>Nama</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Nomor Induk Mahasiswa</label></br>
        <input type="text" name="nim" id="nim" class="form-control"></br>
        <label>Angkatan</label></br>
        <select class="form-control" name="angkatan">
          <option value="2010">2010</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
          <option value="2016">2016</option>
          <option value="2017">2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
        </select><br>
        <label>Program Studi</label></br>
        <input type="text" name="prodi" id="prodi" class="form-control"></br>
        <label>Nomor Telepon</label></br>
        <input type="text" name="telepon" id="telepon" class="form-control"></br>
        <label>Jenis Kelamin</label></br>
        <select class="form-control" name="jenis_kelamin">
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select></br>
        <label>Pekerjaan</label></br>
        <select class="form-control" name="pekerjaan">
          <option value="Bekerja">Bekerja</option>
          <option value="Berwirausaha">Berwirausaha</option>
        </select><br>
        <label>Tempat Kerja</label></br>
        <select class="form-control" name="tempat_kerja">
          <option value="Aceh">
            ACEH
          </option>
          <option value="Sumatera Utara">
            SUMATERA UTARA
          </option>
          <option value="Sumatera Barat">
            SUMATERA BARAT
          </option>
          <option value="Riau">
            RIAU
          </option>
          <option value="Jambi">
            JAMBI
          </option>
          <option value="Sumatera Selatan">
            SUMATERA SELATAN
          </option>
          <option value="Bengkulu">
            BENGKULU
          </option>
          <option value="Lampung">
            LAMPUNG
          </option>
          <option value="Kepulauan Riau">
            KEPULAUAN RIAU
          </option>
          <option value="Jakarta">
            DKI JAKARTA
          </option>
          <option value="Jawa Barat">
            JAWA BARAT
          </option>
          <option value="Jawa Tengah">
            JAWA TENGAH
          </option>
          <option value="Yogyakarta">
            DI YOGYAKARTA
          </option>
          <option value="Jawa Timur">
            JAWA TIMUR
          </option>
          <option value="Banten">
            BANTEN
          </option>
          <option value="Bali">
            BALI
          </option>
          <option value="Nusa Tenggara Barat">
            NUSA TENGGARA BARAT
          </option>
          <option value="Nusa Tenggara Timur">
            NUSA TENGGARA TIMUR
          </option>
          <option value="Kalimantan Barat">
            KALIMANTAN BARAT
          </option>
          <option value="Kalimantan Tengah">
            KALIMANTAN TENGAH
          </option>
          <option value="Kalimantan Selatan">
            KALIMANTAN SELATAN
          </option>
          <option value="Kalimantan Timur">
            KALIMANTAN TIMUR
          </option>
          <option value="Sulawesi Utara">
            SULAWESI UTARA
          </option>
          <option value="Sulawesi Selatan">
            SULAWESI SELATAN
          </option>
          <option value="Sulawesi Tenggara">
            SULAWESI TENGGARA
          </option>
          <option value="Gorontalo">
            GORONTALO
          </option>
          <option value="Sulawesi Barat">
            SULAWESI BARAT
          </option>
          <option value="Maluku">
            MALUKU
          </option>
          <option value="Maluku Utara">
            MALUKU UTARA
          </option>
          <option value="Papua">
            PAPUA
          </option>
          <option value="Papua Barat">
            PAPUA BARAT
          </option>
          <option value="Sulawesi Tengah">
            SULAWESI TENGAH
          </option>
          <option value="Kalimantan Utara">
            KALIMANTAN UTARA
          </option>
        </select><br>
        <input type="submit" value="Save" class="btn btn-success"><br><br>
        @if ($errors->any())
        <p class="text-danger">{{ $errors->first() }}</p><br>
        @endif
      </form>

    </div>
  </div>
</section>
@stop