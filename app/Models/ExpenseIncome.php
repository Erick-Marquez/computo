<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseIncome extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'type',
        'amount',
        'observation',
        'user_id',
        'branch_id',
        'payment_type_id'
    ];

    protected $table = 'expenses_incomes';

    protected $allowIncluded = [];
    protected $allowFilter = ['id'];
    protected $allowSort = ['id'];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
