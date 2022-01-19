<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    const INGRESO = 'INGRESO';
    const SALIDA = 'SALIDA';
    
    const VENTA = 'VENTA';
    const COMPRA = 'COMPRA';
    const MODIFICA_STOCK = 'MODIFICA STOCK';
    const MOVIMIENTO_SUCURSAL = 'MOVIMIENTO SUCURSAL';
    const INVENTARIO_INICIAL = 'INVENTARIO INICIAL';
    const DEVOLUCION = 'DEVOLUCIÓN';
    const BAJA = 'BAJA';
    const ANULACION = 'DEVOLUCIÓN POR ANULACIÓN';
    const NOTA_CREDITO = 'DEVOLUCIÓN POR NOTA DE CRÉDITO';
    const EDITAR_SERIES_SALIDA = 'SALIDA POR EDICIÓN DE SERIE';
    const EDITAR_SERIES_INGRESO = 'INGRESO POR EDICIÓN DE SERIE';


    protected $table = "kardex";

    protected $fillable = [
        'date',
        'quantity',
        'movement_type',
        'description',
        'document',
        'series',
        'branch_product_id',
        'user_id'
    ];

    protected $casts = [
        'series' => 'array'
    ];

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
