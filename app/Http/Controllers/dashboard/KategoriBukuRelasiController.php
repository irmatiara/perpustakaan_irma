<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\KategoriBukuRelasi;
use App\Models\Bukubuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class KategoriBukuRelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KategoriBukuRelasi $kategoribukurelasi)
    {
        $q = $request->input('q');

        $active = 'Kategori Buku Relasi';

        $kategoribukurelasi = $kategoribukurelasi->when($q, function($query) use ($q) {
            return $query->where('bukuid', 'like', '%' .$q. '%');
        })

        ->paginate(10);
        return view('dashboard/kategoribukurelasi/list', [
            'kategoribukurelasi' => $kategoribukurelasi,
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
        $bukubuku = Bukubuku::all(); //ambil semua data yang diperlukan
        $kategoriBuku = KategoriBuku::all(); //jika diperlukan, ambil juga data kategori buku
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }
}
