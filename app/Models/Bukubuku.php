<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukubuku extends Model
{
    protected $table = 'bukubuku';
    protected $primaryKey = 'bukuid';

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategoriid');
    }
}
