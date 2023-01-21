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
            <a href="{{ url('/akun') }}" class="list-group-item list-group-item-action py-2 ripple active">
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
        <div class="col-md-9">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Data Akun</strong></h5>
                </div>
                <div class="card-body">
                    @if (session()->get('role') == "Admin")
                    <a href="{{ url('/akun/create') }}" class="btn btn-success btn-sm" title="Tambah Akun">
                        Tambah
                    </a>
                    <br />
                    <br />
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    @if (session()->get('role') == "Admin")
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->password }}</td>
                                    @if (session()->get('role') == "Admin")
                                    <td>
                                        <a href="{{ url('/akun/' . $user->id) }}" title="Lihat Akun"><button class="btn btn-info btn-sm">Lihat</button></a>
                                        <a href="{{ url('/akun/' . $user->id . '/edit') }}" title="Edit Akun"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></a>

                                        <form method="POST" action="{{ url('/akun' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Akun" onclick="return confirm('Konfirmasi hapus?')"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</button>
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
        </div>
    </div>
    </div>
    @if ($errors->any())
    <script>
        alert("{{ $errors->first()}}");
    </script>
    @endif
    @endsection