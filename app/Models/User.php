<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← tambahkan
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory; // ← tambahkan

    protected $fillable = ['username', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
