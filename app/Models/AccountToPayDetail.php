<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountToPayDetail extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'account_to_pay_id',
        'payment_type_id',
        'amount',
        'date_issue',
    ];

    public $timestamps = false;

    protected $allowIncluded = ['account_to_pay', 'paymentType'];
    protected $allowFilter = ['id'];
    protected $allowSort = ['id'];

    protected $table = 'account_to_pay_details';

    public function accountToPay()
    {
        return $this->belongsTo(AccountToPay::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
