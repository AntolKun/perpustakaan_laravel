<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'foto',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


