<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];
    public function detailperiksa(): BelongsTo
    {
        return $this->belongsTo(DetailPeriksa::class,'id');
    }
}
