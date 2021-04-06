@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Detail Mahasiswa
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nim: </b>{{$mahasiswa->nim}}</li>
                    <li class="list-group-item"><b>Nama: </b>{{$mahasiswa->nama}}</li>
                    <li class="list-group-item"><b>Kelas: </b>{{$mahasiswa->kelas->nama_kelas}}</li>
                    <li class="list-group-item"><b>Jurusan: </b>{{$mahasiswa->jurusan}}</li>
                    <li class="list-group-item"><b>No Handphone: </b>{{$mahasiswa->no_handphone}}</li>
                    <li class="list-group-item"><b>Jurusan: </b>{{$mahasiswa->jurusan}}</li>
                    <li class="list-group-item"><b>No Handphone: </b>{{$mahasiswa->no_handphone}}</li>
                    <li class="list-group-item"><b>Email: </b>{{$mahasiswa->email}}</li>
                    <li class="list-group-item"><b>Tanggal Lahir: </b>{{isset($mahasiswa->tanggal_lahir) ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->toFormattedDateString() : ''}}</li>
                </ul>
            </div>
            <a class="btn btn-success mx-3" href="{{ route('mahasiswa.index') }}">Kembali</a>
            <div class="d-flex justify-content-between">
                <a class="btn m-3 {{isset($prev->nim) ? 'btn-outline-primary' : 'disabled' }}" href="{{ isset($prev->nim) ? route('mahasiswa.show', $prev->nim) : '' }}"><i class="fas fa-chevron-left"></i> Sebelumnya</i></a>
                <a class="btn m-3 {{isset($next->nim) ? 'btn-outline-primary' : 'disabled' }}" href="{{ isset($next->nim) ? route('mahasiswa.show', $next->nim) : '' }}">Selanjutnya <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection