<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RentalTransaction extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "rental_transactions";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'mobil_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
