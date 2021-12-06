<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use ApiTrait,HasFactory;

    protected $fillable = [
        'description'
    ];

    protected $allowIncluded = ['account_to_pay_details'];
    protected $allowFilter = ['id'];
    protected $allowSort = ['id'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot(["amount"]);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function accountToPayDetails()
    {
        return $this->hasMany(AccountToPayDetail::class);
    }
}
