<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Eloquent untuk menampilkan data dengan pagination
        $mahasiswas = Mahasiswa::all();
        $paginatedMahasiswas = Mahasiswa::orderBy('nim', 'desc')->paginate(5);
        return view('mahasiswa.index', compact('mahasiswas', 'paginatedMahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi request
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date'
        ]);

        //eloquent untuk insert data
        Mahasiswa::create($request->all());

        //jika berhasil, kembalike halaman utama
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //eloquent untuk mengambil 1 data yang sesuai dalam bentuk objek
        $mahasiswa = Mahasiswa::find($nim);

        //eloquent untuk mengambil data sebelum dan sesudah data sekarang
        $next = Mahasiswa::where('nim', '<', $nim)->orderBy('nim','desc')->first();
        $prev = Mahasiswa::where('nim', '>', $nim)->orderBy('nim')->first();

        return view('mahasiswa.detail', compact('mahasiswa', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //eloquent untuk mengambil 1 data yang sesuai dalam bentuk objek
        $mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //validasi request
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date'
        ]);

        //eloquent untuk insert data
        Mahasiswa::find($nim)->update($request->all());

        //jika berhasil, kembalike halaman utama
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();

        //jika berhasil, kembalike halaman utama
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
