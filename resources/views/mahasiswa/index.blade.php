@extends('mahasiswa.layout')
@section('content')
<div class="row m-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2 mb-3">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <form class="float-right form-inline" id="searchForm" method="get" action="{{ route('mahasiswa.index') }}" role="search">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" id="Keyword" aria-describedby="Keyword" placeholder="Keyword" value="{{request()->query('keyword')}}">
            </div>
            <button type="submit" class="btn btn-primary mx-2">Cari</button>
            <a href="{{ route('mahasiswa.index') }}">
                <button type="button" class="btn btn-danger">Reset</button>
            </a>
        </form>
        <div class="my-2">
            <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa </a>
        </div>
    </div>

    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Tanggal Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($mahasiswas_relasi as $mahasiswa)
        <tr>
            <td>{{$mahasiswa->nim}}</td>
            <td>{{$mahasiswa->nama}}</td>
            <td>{{$mahasiswa->kelas->nama_kelas}}</td>
            <td>{{$mahasiswa->jurusan}}</td>
            <td>{{$mahasiswa->no_handphone}}</td>
            <td>{{$mahasiswa->email}}</td>
            <td>{{isset($mahasiswa->tanggal_lahir) ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->toFormattedDateString() : ''}}</td>
            <td>
                <form action="{{route('mahasiswa.destroy', $mahasiswa->nim) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('mahasiswa.show', $mahasiswa->nim) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}">Edit</a>
                    <a class="btn btn-warning" href="{{ route('mahasiswa.khs', $mahasiswa->nim) }}">Nilai</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {{ $mahasiswas_relasi->links('pagination::bootstrap-4') }}
    </div>
</div>