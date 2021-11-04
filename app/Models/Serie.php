<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'serie',
        'current_number',
        'branch_id',
        'voucher_type_id'
    ];

    protected $allowIncluded = ['branch', 'voucher_type'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
