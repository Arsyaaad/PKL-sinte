<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'nama',
        'deskripsi',
        'problem',
        'solution',
        'pelanggan_id',

    ];
    
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/produks/'.$image),
        );
    }

 // Relasi ke tabel Pelanggan (Many-to-One)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // Relasi ke tabel Maintenance (One-to-Many)
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'maintenance_id');
    }
}
