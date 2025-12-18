<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['nm_produk', 'gender_id', 'brand', 'ganti_nama', 'foto', 'diskon', 'status', 'possition', 'hapus'];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function produkCabang()
    {
        return $this->hasMany(ProdukCabang::class, 'produk_id', 'id');
    }

    public function resep()
    {
        return $this->hasMany(Resep::class, 'produk_id', 'id');
    }
}
