<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
    ];

    protected $table = "voucher_types";

    public $incrementing = false;

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'series', 'voucher_type_id', 'branch_id');
    }
}
