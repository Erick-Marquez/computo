<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'document_type',
        'document_number',
        'serie',
        'handles_exchange_rate',
        'exchange_rate',
        'is_credit',
        'date_issue',
        'subtotal',
        'total_igv',
        'total',
        'observation',
        'provider_id',
        'open_closed_cashbox_id',
    ];

    protected $allowIncluded = ['provider', 'provider.identificationDocument','accountToPay'];
    protected $allowFilter = ['id', 'document_type', 'date_issue', 'provider_id'];
    protected $allowSort = ['id'];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function accountToPay()
    {
        return $this->hasOne(AccountToPay::class);
    }

    /**
     * * METODOS ESTATICOS DEL MODELO
    */

    public static function getPurchasesToday($date, $brach_id)
    {
        return Purchase::whereDate('date_issue', '>=', date($date))->sum('total');
    }
}
