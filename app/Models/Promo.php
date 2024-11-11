<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'jenis',
        'keterangan',
        'jenis_potongan',
        'nilai_potongan',
        'periode',
        'status',
    ];
}