<?php

namespace App\Services;

use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\Kardex;
use Carbon\Carbon;

class KardexService
{
    
    public static function sale($data)
    {   

        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::SALIDA,
            'description' => Kardex::VENTA,
            'document' => $data['document'],
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($data['branch_product_id']);
        $branchProduct->stock = $branchProduct->stock - $data['quantity'];
        $branchProduct->save();

        // Vender las series si maneja series
        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($data['series'] as $key => $serie) { // Iterar cada serie del array
                BranchProductSerie::where('serie', $serie)->where('branch_product_id', $data['branch_product_id'])->update(["sold" => true]); //actualizar serie a vendido
            }
        }   
    }

    public static function purchase($data)
    {   
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::COMPRA,
            'document' => $data['document'],
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($data['branch_product_id']);
        $branchProduct->stock = $branchProduct->stock + $data['quantity'];
        $branchProduct->save();

        // Agregar las series si maneja serie
        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($data['series'] as $key => $serie) { // Iterar cada serie del array

                // Agregar las series
                BranchProductSerie::create([
                    'serie' => $serie,
                    'branch_product_id' => $data['branch_product_id']
                ]);

            }
        }
    }

    public static function stockModification(
        Int $quantity,
        String $operation,
        Array $series,
        Int $branch_product_id,
        Int $user_id
    )
    {   
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $quantity,
            'movement_type' => $operation == 'suma' ? Kardex::INGRESO : Kardex::SALIDA, // Determinar si es aumento o disminucion
            'description' => Kardex::MODIFICA_STOCK,
            'series' => $series,
            'branch_product_id' => $branch_product_id,
            'user_id' => $user_id,
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($branch_product_id);
        $branchProduct->stock = $operation == 'suma' ? $branchProduct->stock + $quantity : $branchProduct->stock - $quantity; // Determinar si es aumento o disminucion
        $branchProduct->save();

        // Agregar las series si maneja serie
        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($series as $serie) { // Iterar cada serie del array

                if ($operation == 'suma') {
                    // Agregar las series
                    BranchProductSerie::create([
                        'serie' => $serie,
                        'branch_product_id' => $branch_product_id
                    ]);
                }
                else{
                    // Eliminar Series
                    BranchProductSerie::where('serie', $serie)->delete();
                }

            }
        }
    }

    public static function outOfOrder($data)
    {   
        
    }

    public static function movement($data)
    {   
        //Kardex producto en origen
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::SALIDA,
            'description' => Kardex::MOVIMIENTO_SUCURSAL,
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);

        // Restamos del stock de productos de la sucursal origen
        $branchProductOrigin = BranchProduct::find($data['branch_product_id']);
        $branchProductOrigin->stock = $branchProductOrigin->stock - $data['quantity'];
        $branchProductOrigin->save();

        //Kardex producto en destino
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::MOVIMIENTO_SUCURSAL,
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);

        // Determinar si el producto esta en la sucursal si no esta añadirlo


        // Sumar al stock de productos de la sucursal destino
        $branchProductDestination = BranchProduct::find($data['branch_product_id']);
        $branchProductDestination->stock = $branchProductDestination->stock + $data['quantity'];
        $branchProductDestination->save();

        // Cambiar el branch product de las series


    }

    public static function devolution($data)
    {   
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::DEVOLUCION,
            'document' => $data['document'],
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);
    }

    public static function voided(
        Int $quantity, 
        String $document, 
        Array $series, 
        Int $branch_product_id, 
        Int $user_id
    )
    {
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $quantity,
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::ANULACION,
            'document' => $document,
            'series' => $series,
            'branch_product_id' => $branch_product_id,
            'user_id' => $user_id,
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($branch_product_id);
        $branchProduct->stock = $branchProduct->stock + $quantity;
        $branchProduct->save();


        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($series as $serie) { // Iterar cada serie del array
                BranchProductSerie::where('serie', $serie)->where('branch_product_id', $branch_product_id)->update(["sold" => false]); //actualizar serie a no vendido
            }
        } 
    }

    public static function creditNote(
        Int $quantity, 
        String $document, 
        Array $series, 
        Int $branch_product_id, 
        Int $user_id
    )
    {
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $quantity,
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::NOTA_CREDITO,
            'document' => $document,
            'series' => $series,
            'branch_product_id' => $branch_product_id,
            'user_id' => $user_id,
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($branch_product_id);
        $branchProduct->stock = $branchProduct->stock + $quantity;
        $branchProduct->save();


        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($series as $serie) { // Iterar cada serie del array
                BranchProductSerie::where('serie', $serie)->where('branch_product_id', $branch_product_id)->update(["sold" => false]); //actualizar serie a no vendido
            }
        } 
    }

    public static function serieEdit( 
        Array $oldSerie,
        Array $newSerie,
        Int $branch_product_id, 
        Int $user_id
    )
    {
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => 1,
            'movement_type' => Kardex::SALIDA,
            'description' => Kardex::EDITAR_SERIES_SALIDA,
            'series' => $oldSerie,
            'branch_product_id' => $branch_product_id,
            'user_id' => $user_id,
        ]);

        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => 1,
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::EDITAR_SERIES_INGRESO,
            'series' => $newSerie,
            'branch_product_id' => $branch_product_id,
            'user_id' => $user_id,
        ]);
    }

    public static function initialStock($data)
    {   
        $kardex = Kardex::create([
            'date' => Carbon::now()->toDateTimeString(),
            'quantity' => $data['quantity'],
            'movement_type' => Kardex::INGRESO,
            'description' => Kardex::INVENTARIO_INICIAL,
            'series' => $data['series'],
            'branch_product_id' => $data['branch_product_id'],
            'user_id' => $data['user_id'],
        ]);

        // Actualizar stock de productos
        $branchProduct = BranchProduct::find($data['branch_product_id']);
        $branchProduct->stock = $branchProduct->stock + $data['quantity'];
        $branchProduct->save();

        // Agregar las series si maneja serie
        if ($branchProduct->manager_series) { //Comprobar si maneja series
            foreach ($data['series'] as $key => $serie) { // Iterar cada serie del array

                // Agregar las series
                BranchProductSerie::create([
                    'serie' => $serie,
                    'branch_product_id' => $data['branch_product_id']
                ]);

            }
        }
    }

}