@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your i
                    nput.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" id="myForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="Nim" value="{{ $mahasiswa->nim }}" aria- describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="Nama" value="{{ $mahasiswa->nama }}" aria- describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach($kelases as $kelas)
                            <option value="{{$kelas->id}}" {{$mahasiswa->kelas_id == $kelas->id ? 'selected' : ''}}>{{$kelas->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->jurusan }}" aria- describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="No_Handphone">No_Handphone</label>
                        <input type="No_Handphone" name="no_handphone" class="form-control" id="No_Handphone" value="{{ $mahasiswa->no_handphone }}" aria- describedby="No_Handphone">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="email" class="form-control" id="Email" value="{{ $mahasiswa->email }}" aria-describedby="Email">
                    </div>
                    <div class="form-group">
                        <label for="Tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="Tanggal_lahir" value="{{\Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->toDateString()}}" aria-describedby="Tanggal_lahir">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection