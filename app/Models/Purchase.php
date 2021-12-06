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
        'exchange_rate',
        'date_issue',
        'subtotal',
        'total_igv',
        'total',
        'observation',
        'provider_id',
        'open_closed_cashbox_id'
    ];

    protected $allowIncluded = ['provider'];
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

    public function openClosedCashbox()
    {
        return $this->belongsTo(OpenClosedCashbox::class);
    }

    public function accountToPay()
    {
        return $this->hasOne(AccountToPay::class);
    }

    /**
     * * METODOS ESTATICOS DEL MODELO
    */

    public static function getPurchasesToday()
    {
        return Purchase::where('date_issue', date('Y-m-d'))->sum('total');
    }
}
