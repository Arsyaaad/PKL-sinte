<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
