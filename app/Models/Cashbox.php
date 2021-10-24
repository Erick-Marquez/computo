<?php

namespace App\Models;

use App\Services\CashboxService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'state',
        'branch_id'
    ];

    // Relacion inversa de muchos a uno
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relacion de uno a muchos
    public function openClosedCashboxes()
    {
        return $this->hasMany(OpenClosedCashbox::class);
    }

    // *TODO: METODOS PARA OBTENER EL BALANCE Y USUARIO DE LA CAJA
    public function balanceCurrently($id)
    {
        $cashbox = Cashbox::findOrFail($id);

        if($cashbox['state']) {
            return 'si tiene balance';
        }

        return 'no tiene balance';
    }

    // *! METODOS RECURRENTES PARA CAJA
    public function balance($id)
    {
        if( $this->state ) {
            return CashboxService::balance($id);
        }

        return 0;
    }

}
