<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "profiles";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'alamat',
        'no_telepon',
        'sim',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
