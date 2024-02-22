<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KategoriBuku $kategoribuku)
    {
        $q = $request->input('q');

        $active = 'Kategoribuku';

        $kategoribuku = $kategoribuku->when($q, function($query) use ($q) {
                return $query->where('kategoriid', 'like', '%' .$q. '%');
            })

        ->paginate(10);
        return view('dashboard/kategoribuku/list', [
            'kategoribuku' => $kategoribuku,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Kategoribuku';
        return view('dashboard/kategoribuku/form', [
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.kategoribuku.store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namakategori'=> 'required|unique:App\Models\KategoriBuku,namakategori',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.kategoribuku.create')
                ->withErrors($validator)
                ->withInput();
       } else {
        $kategori = New Kategori(); //Tambahkan ini untuk membuat objek Kategori Buku
        $kategori->namakategori = $request->input('namakategori');
        $kategori->save();

        return redirect()->route('dashboard.kategoribuku');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriBuku $kategoriBuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriBuku $kategoriBuku)
    {
        //
    }
}
