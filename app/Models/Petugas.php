<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
    ];

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
