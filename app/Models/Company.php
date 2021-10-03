<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'comercial_name',
        'phone',
        'email',
        'address',
        'user_sol',
        'password_sol',
        'demo'
    ];

    protected $table = "company";
}
