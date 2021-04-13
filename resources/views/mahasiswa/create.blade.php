@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Tambah Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="Nim" aria-describedby="Nim" value="{{old('nim')}}">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="Nama" aria-describedby="Nama" value="{{old('nama')}}">
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input type="file" name="foto" class="form-control-file" id="Foto" aria-describedby="Foto" value="{{old('foto')}}">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach($kelases as $kelas)
                                <option value="{{$kelas->id}}" {{old('kelas') == $kelas->id ? 'selected' : ''}}>{{$kelas->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" id="Jurusan" aria-describedby="Jurusan" value="{{old('jurusan')}}">
                    </div>
                    <div class="form-group">
                        <label for="No_Handphone">No_Handphone</label>
                        <input type="number" name="no_handphone" class="form-control" id="No_Handphone" aria-describedby="No_Handphone" value="{{old('no_handphone')}}">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="email" class="form-control" id="Email" aria-describedby="Email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="Tanggal_lahir" aria-describedby="Tanggal_lahir" value="{{old('tanggal_lahir')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection