<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Eloquent untuk menampilkan data mahasiswa, dengan atau tanpa search
        $mahasiswas = Mahasiswa::where([
            ['nim', '!=', null, 'OR', 'nama', '!=', null], //ketika form search kosong, maka request akan null. Ambil semua data di database
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('nim', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('nama', 'LIKE', '%' . $keyword . '%')->get(); //ketika form search terisi, request tidak null. Ambil data sesuai keyword
                }
            }]
        ])
            ->orderBy('nim', 'desc')
            ->paginate(5);
        
        $mahasiswas_relasi = Mahasiswa::with('kelas')
            ->orderBy('nim')
            ->paginate(5);
        return view('mahasiswa.index', compact('mahasiswas', 'mahasiswas_relasi'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelases = Kelas::all();
        return view('mahasiswa.create', compact('kelases'));
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

        //eloquent untuk insert data mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_handphone = $request->get('no_handphone');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');

        //Menyimpan id kelas yang merupakan foreign key
        $kelas = new Kelas();
        $kelas->id = $request->get('kelas');
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

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
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_khs($nim)
    {
        $mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->where('nim', $nim)->first();
        // dd($mahasiswa->matakuliah[0]);
        return view('mahasiswa.khs', compact('mahasiswa'));
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
        $kelases = Kelas::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelases'));
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

        //eloquent untuk insert data mahasiswa
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_handphone = $request->get('no_handphone');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');

        //Menyimpan id kelas yang merupakan foreign key
        $kelas = new Kelas();
        $kelas->id = $request->get('kelas');
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

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
