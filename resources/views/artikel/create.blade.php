@extends('artikel.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto col-md-10 col-12">
            <form action="{{route('artikel.store')}}" method="post" enctype="multipart/form-data" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control" name="title" required="required" placeholder="Judul">
                    </div>

                    <div class="col-lg-12 col-12">
                        <textarea class="form-control" rows="6" name="content" required="required" placeholder="Konten"></textarea>
                    </div>

                    <div class="col-12">
                        <input type="file" name="image" required="required" placeholder="Masukan gambar...">
                    </div>

                    <div class="col-lg-5 mx-auto col-7">
                        <button type="submit" class="form-control" id="submit-button" name="submit">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection