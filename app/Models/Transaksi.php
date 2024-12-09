<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'no_transaksi',
        'status_pembayaran',
        'total_harga',
        'diskon',
        'poin_earned',
        'tanggal_transaksi',
        'customer_id',
        'dokter_id',
        'customer_service_id',
        'beautician_id',
        'kasir_id',
        'ruangan_id',
        'promo_id'
    ];

    public function customer() 
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function dokter() 
    {
        return $this->belongsTo(Pegawai::class, 'dokter_id');
    }

    public function cs() 
    {
        return $this->belongsTo(Pegawai::class, 'customer_service_id');
    }

    public function beautician() 
    {
        return $this->belongsTo(Pegawai::class, 'beautician_id');
    }

    public function kasir() 
    {
        return $this->belongsTo(Pegawai::class, 'kasir_id');
    }

    public function ruangan() 
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function promo() 
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }

    public function detailPerawatan()
    {
        return $this->hasMany(DetailPerawatan::class);
    }

    public function detailProduk()
    {
        return $this->hasMany(DetailProduk::class);
    }
}
