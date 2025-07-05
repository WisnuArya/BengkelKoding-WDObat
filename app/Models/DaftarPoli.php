<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';
   

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'tanggal_daftar',
        'no_antrean',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date'
        ];
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar');
    }
}
