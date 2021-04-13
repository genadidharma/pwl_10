<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artikel.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');

            Artikel::create([
                'title' => $request->title,
                'content' => $request->content,
                'featured_image' => $image_name
            ]);
    
            return 'Artikel berhasil disimpan';
        }

        return 'Artikel gagal disimpan';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::find($id);
        return view('artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::find($id);

        $artikel->title = $request->title;
        $artikel->content = $request->content;

        if($artikel->featured_image && file_exists(storage_path('app/public' . $artikel->featured_image))){
            Storage::delete('public/' . $artikel->featured_image);
        }

        $image_name = $request->file('image')->store('images', 'public');
        $artikel->featured_image = $image_name;

        $artikel->save();
        return 'Artikel berhasil diubah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        //
    }

    public function cetak_pdf(){
        $artikel = Artikel::all();
        $pdf = PDF::loadView('artikel.export_pdf', compact('artikel'));
        return $pdf->stream();
    }
}
