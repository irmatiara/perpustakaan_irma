<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Buku $books)
    {
        $q = $request->input('q');

        $active = 'Books';

        $books = $books->when($q, function($query) use ($q) {
                return $query->where('title', 'like', '%' .$q. '%')
                             ->orwhere('description', 'like', '%' .$q. '%');
            })

        ->paginate(10);
        return view('dashboard/buku/list', [
            'books' => $books,
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
        $active = 'Books';
        return view('dashboard/buku/form', [
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.books.store'
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
            'title'         => 'required|unique:App\Models\Buku,title',
            'description'   => 'required',
            'thumbnail'     => 'required|image',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.books.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $buku = new Buku(); //Tambahkan ini untuk membuat objek Buku
            $image = $request->file('thumbnail');
            $filename = time() . '.' .$image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/buku', $image, $filename);

            $buku->title = $request->input('title');
            $buku->description = $request->input('description');
            $buku->thumbnail = $filename; //Ganti dengan nama file yang baru diupload
            $buku->penulis = $request->input('penulis');
            $buku->penerbit = $request->input('penerbit');
            $buku->tahun_terbit = $request->input('tahun_terbit');
            $buku->save();

            return redirect()->route('dashboard.books');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
        $active = 'Books';
        return view('dashboard/buku/form', [
            'active' => $active,
            'buku'   => $buku,
            'button' =>'Update',        
            'url'    =>'dashboard.books.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        //
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:App\Models\Buku,title,'.$buku->bukuid,
            'description'   => 'required',
            'thumbnail'     => 'image',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.books.update', $buku->bukuid)
                ->withErrors($validator)
                ->withInput();
        } else {
            //$buku = new Buku(); //Tambahkan ini untuk membuat objek Buku
            if($request->hasFile('thumbnail')){
                $image = $request->file('thumbnail');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('local')->putFileAs('public/buku', $image, $filename);
                $buku->thumbnail = $filename; //Ganti dengan nama file yang baru diupload
            }
            $buku->title = $request->input('title');
            $buku->description = $request->input('description');
            $buku->penulis = $request->input('penulis');
            $buku->penerbit = $request->input('penerbit');
            $buku->tahun_terbit = $request->input('tahun_terbit');
            $buku->save();

            return redirect()->route('dashboard.books');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //
        $buku->delete();
        return redirect()
                ->route('dashboard.books');
    }
}
