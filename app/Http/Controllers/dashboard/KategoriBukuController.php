<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
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

        $active = 'Kategori Buku';

        $kategoribuku = $kategoribuku->when($q, function($query) use ($q) {
                return $query->where('namakategori', 'like', '%' .$q. '%');
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
        $active = 'Kategori Buku';
        return view('dashboard/kategoribuku/form', [
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.kategoribuku.store'
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
            'namakategori' => 'required',       
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.kategoribuku.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $kategoribuku = new KategoriBuku(); //Tambahkan ini untuk membuat objek KategoriBuku
            $kategoribuku->namakategori = $request->input('namakategori');
            $kategoribuku->save();

            return redirect()
                ->route('dashboard.kategoribuku')
                ->with('message', __('message.store', ['namakategori'=>$request->input('namakategori')]));
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
    public function edit(KategoriBuku $kategori)
    {
        $active = 'Kategori Buku';
        return view('dashboard/kategoribuku/form', [
            'active'         => $active,
            'kategori'       => $kategori,
            'button'         =>'Update',        
            'url'            =>'dashboard.kategoribuku.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriBuku $kategori)
    {
        $validator = Validator::make($request->all(), [
            'namakategori' => 'required|unique:App\Models\KategoriBuku,namakategori,'.$kategori->kategoriid,  
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.kategoribuku.update')
                ->withErrors($validator)
                ->withInput();
        } else {
            $kategori->namakategori = $request->input('namakategori');
            $kategori->save();

            return redirect()
                ->route('dashboard.kategoribuku')
                ->with('message', __('message.update', ['namakategori'=>$request->input('namakategori')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriBuku  $kategoriBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriBuku $kategori)
    {
        $title = $kategori->title;

        $kategori->delete();
        return redirect()
                ->route('dashboard.kategoribuku')
                ->with('message', __('message.delete', ['title' => $title]));
    }
}
