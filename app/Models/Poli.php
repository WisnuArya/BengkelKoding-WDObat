<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    //
    protected $table = 'poli';


    protected $fillable = [
        'nama_poli',
        'kode_poli',
        'spesialis',
    ];

    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
    public function jadwalPoli()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_poli');
    }
}
