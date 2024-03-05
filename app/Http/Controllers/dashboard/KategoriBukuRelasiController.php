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
                    return $query->where('bukuid', 'like', '%' .$q. '%')
                                 ->orwhere('kategoriid', 'like', '%' .$q. '%');
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
        $bukubuku = Bukubuku::all(); // Ambil semua data buku yang diperlukan
        $kategoriBuku = KategoriBuku::all(); // Jika diperlukan, ambil juga data kategori buku
        $active = 'Kategori Buku Relasi';
        return view('dashboard/kategoribukurelasi/form', [
            'bukubuku' => $bukubuku,
            'kategoriBuku' => $kategoriBuku,
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.kategoribukurelasi.store'
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
            'bukuid'         => 'required|unique:App\Models\KategoriBukuRelasi,Bukuid',
            'kategoriid'   => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.kategoribukurelasi.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $kategoribukurelasi = new KategoriBukuRelasi(); //Tambahkan ini untuk membuat objek KategoriBukuRelasi
            $kategoribukurelasi->bukuid = $request->input('bukuid');
            $kategoribukurelasi->kategoriid = $request->input('kategoriid');
            $kategoribukurelasi->save();
    
            return redirect()
                ->route('dashboard.kategoribukurelasi')
                ->with('message', __('message.store', ['title'=>$request->input('title')]));
        }
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
    public function edit(KategoriBukuRelasi $relasi)
    {
        $bukubuku = Bukubuku::all(); // Ambil semua data buku
        $kategoriBuku = KategoriBuku::all(); // Ambil semua data kategori buku
        $active = 'Kategori Buku Relasi';
        return view('dashboard/kategoriBukuRelasi/form', [
            'active' => $active,
            'relasi' => $relasi,
            'bukubuku'   => $bukubuku,
            'kategoriBuku' => $kategoriBuku,
            'button' =>'Update',        
            'url'    =>'dashboard.kategoribukurelasi.update'
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriBukuRelasi $relasi)
    {
        $validator = Validator::make($request->all(), [
            'bukuid'         => 'required|unique:App\Models\KategoriBukuRelasi,bukuid,'.$relasi->kategoribukuid,
            'kategoriid'   => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.kategoribukurelasi.update', $relasi->kategoribukuid)
                ->withErrors($validator)
                ->withInput();
        } else {
            $relasi->bukuid = $request->input('bukuid');
            $relasi->kategoriid = $request->input('kategoriid');
            $relasi->save();

            return redirect()
                        ->route('dashboard.kategoribukurelasi')
                        ->with('message', __('message.update', ['bukuid'=>$request->input('bukuid')]));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\KategoriBukuRelasi  $kategoriBukuRelasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriBukuRelasi $relasi)
    {
        $relasi->delete();
        return redirect()
                ->route('dashboard.kategoribukurelasi')
                ->with('message', __('message.delete'));
    }
}
    