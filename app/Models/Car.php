<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "cars";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'merek',
        'model',
        'nomor_plat',
        'tarif_sewa',
        'stock'
    ];

    public function rental(): HasMany
    {
        return $this->hasMany(RentalTransaction::class, 'mobil_id');
    }
}
