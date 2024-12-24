<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_awal',
        'tanggal_akhir',
        'jumlah_maintenance',
        'produk_id',
        'petugas_id',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
    public function detailmaintenance()
    {
        return $this->hasMany(DetailMaintenance::class);
    }
}
