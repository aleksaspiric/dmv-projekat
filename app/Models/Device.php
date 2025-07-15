<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'type', 'location', 'status', 'battery'];//massAsignment attack
    /** @use HasFactory<\Database\Factories\DeviceFactory> */
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
