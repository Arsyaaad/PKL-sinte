<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Detail_Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'laporan_bug',
        'maintenance_id',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance_id');
    }
}
