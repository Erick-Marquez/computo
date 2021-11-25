<?php

namespace App\Models;

use App\Services\CashboxService;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'description',
        'is_open',
        'branch_id'
    ];

    protected $allowIncluded = ['openClosedCashboxes'];
    protected $allowFilter = ['is_open'];
    protected $allowSort = ['id'];

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

    // *! METODOS RECURRENTES PARA CAJA
    public function balance($id)
    {

        if( $this->is_open ) {
            return CashboxService::balance($id);
        }

        return 0;
    }

}
