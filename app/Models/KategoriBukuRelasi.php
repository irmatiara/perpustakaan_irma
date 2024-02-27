<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bukubuku; //Impor model Bukubuku
use App\Models\KategoriBuku; //Impor model KategoriBuku

class KategoriBukuRelasi extends Model
{
    protected $table = 'kategoribuku_relasi'; //lakukan penguncian nama table
    protected $primaryKey = 'Kategoribukuid'; //lakukan penguncian primary key

    protected $fillable = ['bukuid', 'kategoriid'];

    public function bukubuku()
    {
        return $this->belongsTo(Bukubuku::class, 'bukuid'); //disini kita melakukan relasi antara tabel buku dan kategoribukurelasi
    }

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategoriid'); //disini kita melakukan relasi antara tabel kategoribuku dan kategorirelasibuku
    }
}
