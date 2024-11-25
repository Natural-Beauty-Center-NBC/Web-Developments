<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_pembelian',
        'jumlah_tukar_point',
        'sub_total',
        'perawatan_id',
        'transaksi_id'
    ];

    public function perawatan()
    {
        return $this->belongsTo(Perawatan::class, 'perawatan_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
