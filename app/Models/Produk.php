<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailProduk;

class Produk extends Model
{
    use HasFactory;

    protected $tbale = 'produks';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'ukuran',
        'stok'
    ];

    public function detailProduk()
    {
        return $this->hasMany(DetailProduk::class);
    }
}
