<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'name',
        'comercial_name',
        'phone',
        'email',
        'ubigeo',
        'urbanization',
        'address',
        'user_sol',
        'password_sol',
        'electronic_certificate',
        'password_electronic_certificate',
        'demo'
    ];

    protected $hidden = [
        'user_sol',
        'password_sol',
        'electronic_certificate',
        'password_electronic_certificate',
    ];

    protected $table = "company";

    public static function active()
    {
        return Company::find(1);
    }
}
