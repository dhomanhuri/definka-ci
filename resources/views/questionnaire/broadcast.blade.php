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
                    <a href="{{ url('/kuisioner/broadcast') }}" class="list-group-item list-group-item-action py-2 ripple active">
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
            <h5 class="mb-0 text-center"><strong>Kuisioner</strong></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Kuisioner</th>
                            <th>Tanggal Broadcast</th>
                            <th>Status Kuisioner</th>
                            <th>Target Angkatan</th>
                            <th>Judul Pertanyaan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kuisioners as $kuisioner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kuisioner->judul_kuisioner }}</td>
                            <td>{{ $kuisioner->tanggal_kirim }}</td>
                            <td class="{{ ($kuisioner->status_kuisioner == 'pending') ? 'text-primary fw-bold text-capitalize' : 'text-success fw-bold text-capitalize' }}">{{ $kuisioner->status_kuisioner }}</td>
                            <td>{{ $kuisioner->target_angkatan }}</td>
                            <td>{{ $kuisioner->judul_pertanyaan }}</td>
                            <td>
                                <a href="{{ url('/kuisioner/' . $kuisioner->id) }}" title="Lihat Kuisioner"><button class="btn btn-info btn-sm">Lihat</button></a>
                                @if ($kuisioner->status_kuisioner == 'pending')
                                <a href="{{ url('/kuisioner/' . $kuisioner->id . '/edit') }}" title="Edit Kuisioner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></a>
                                @endif
                                @if ($kuisioner->status_kuisioner == 'terkirim')
                                <a href="{{ url('/answer/' . $kuisioner->id) }}" title="Lihat Jawaban"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Jawaban</button></a>
                                @endif
                                <form method="POST" action="{{ url('/kuisioner' . '/' . $kuisioner->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Konfirmasi hapus?')"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection