<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountToPayDetail extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'installment',
        'amount',
        'payd',
        'date_issue',
        'account_to_pay_id',
        'payment_type_id',
        'open_closed_cashbox_id',
    ];

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

    public function openClosedCashbox()
    {
        return $this->belongsTo(OpenClosedCashbox::class);
    }
}
