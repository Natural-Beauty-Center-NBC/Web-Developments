<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hari;
use App\Models\Pegawai;
use App\Models\Shift;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = 'penjadwalans';

    protected $fillable = [
        'pegawai_id',
        'shift_id',
        'hari_id'
    ];

    public function pegawai() 
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }
}
