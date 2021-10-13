<?php

namespace App\Models;

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

    public function userCurrently($id)
    {

    }

    // *! METODOS RECURRENTES PARA CAJA
    public function balance()
    {
        if( $this->state ) {
            return $this->openClosedCashboxes()
                        ->orderBy('opening_date', 'DESC')
                        ->first()
                        ->opening_amount;
        }

        return 0;
    }

}