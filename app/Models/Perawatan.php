<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPerawatan;

class Perawatan extends Model
{
    use HasFactory;

    protected $table = 'perawatans';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'tipe',
        'jumlah_potongan_poin'
    ];

    public function detailPerawatan()
    {
        return $this->hasMany(DetailPerawatan::class);
    }
}
