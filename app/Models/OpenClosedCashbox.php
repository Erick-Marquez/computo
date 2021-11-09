<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenClosedCashbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_date',
        'opening_amount',
        'closing_date',
        'closing_amount',
        'state',
        'user_id',
        'cashbox_id',
    ];

    public function cashbox()
    {
        return $this->belongsTo(Cashbox::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELACION DE UNO A MUCHOs
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // RELACION DE UNO A MUCHOs
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // RELACION DE UNO A MUCHO
    public function openClosedCashboxDetails()
    {
        return $this->hasMany(OpenClosedCashboxDetail::class);
    }

    // *TODO: DETALLES

    public function details($id)
    {
        $opening = OpenClosedCashbox::findOrFail($id);
        $expenseIncomes = $opening->openClosedCashboxDetails;

        return $expenseIncomes;
    }
}
