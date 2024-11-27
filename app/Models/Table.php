<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'session_id',
        'qrcode',
        'token',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function activeOrders()
    {
        return $this->hasMany(Order::class)->where('session_id', $this->session_id);
    }
}
