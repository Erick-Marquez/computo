<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountToPay extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'purchase_id',
        'residue',
        'debt',
        'active'
    ];

    protected $allowIncluded = ['purchase', 'purchase.provider', 'accountToPayDetails', 'accountToPayDetails.paymentType'];
    protected $allowFilter = ['id'];
    protected $allowSort = ['id'];

    protected $table = 'accounts_to_pay';

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function accountToPayDetails()
    {
        return $this->hasMany(accountToPayDetail::class);
    }
}
