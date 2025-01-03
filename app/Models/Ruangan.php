<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'no_ruangan',
        'status',
        'assign_to'
    ];

    public function pegawai() 
    {
        return $this->belongsTo(Pegawai::class, 'assign_to');
    }
}
