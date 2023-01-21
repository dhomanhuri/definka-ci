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
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                        <div class="d-flex flex-row">
                            <div class="align-self-center">
                                <i class="fas fa-users fa-3x me-4"></i>
                            </div>
                            <div>
                                <h4>Total Alumni</h4>
                                <p class="mb-0">Total Alumni Keseluruhan</p>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h2 class="h1 mb-0">{{ $alumni['total_count'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                        <div class="d-flex flex-row">
                            <div class="align-self-center">
                                <i class="fas fa-briefcase fa-3x me-4"></i>
                            </div>
                            <div>
                                <h4>Total Bekerja</h4>
                                <p class="mb-0">Total Alumni Bekerja</p>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h2 class="h1 mb-0">{{ $alumni['total_bekerja'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                        <div class="d-flex flex-row">
                            <div class="align-self-center">
                                <i class="fas fa-user-tie fa-3x me-4"></i>
                            </div>
                            <div>
                                <h4>Total Berwirausaha</h4>
                                <p class="mb-0">Total Alumni Berwirausaha</p>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h2 class="h1 mb-0">{{ $alumni['total_berwirausaha'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <h5 class="mb-0 text-center"><strong>Data Alumni</strong></h5>
        </div>
        <div class="card-body">
            @if (session()->get('role') == "Admin")
            <a href="{{ url('/data/create') }}" class="btn btn-success btn-sm" title="Tambah Data">
                Tambah
            </a>
            <a href="{{ url('/generate-pdf') }}" class="btn btn-warning btn-sm" title="Export Data">
                Export Data
            </a>
            <br>
            <br>
            <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <input class="form-control" name="file" type="file" id="formFile">
                    <br>
                    <button class="btn btn-primary">Import Data</button>
                </div>
            </form>
            <br />
            <br />
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Induk Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>No Telepon</th>
                            <th>Jenis Kelamin</th>
                            @if (session()->get('role') == "Admin")
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumni['data'] as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->angkatan }}</td>
                            <td>{{ $user->telepon }}</td>
                            <td>{{ $user->jenis_kelamin }}</td>
                            @if (session()->get('role') == "Admin")
                            <td>
                                <a href="{{ url('/data/' . $user->id) }}" title="Lihat Data"><button class="btn btn-info btn-sm">Lihat</button></a>
                                <a href="{{ url('/data/' . $user->id . '/edit') }}" title="Edit Data"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></a>

                                <form method="POST" action="{{ url('/data' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Konfirmasi hapus?')"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@if ($errors->any())
<script>
    alert("{{ $errors->first()}}");
</script>
@endif
@endsection