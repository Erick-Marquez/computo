<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(); // FECHA DE EMISION
            $table->bigInteger('quantity')->nullable();
            $table->enum('movement_type', ['INGRESO', 'SALIDA']);
            $table->enum('description', ['VENTA', 'MODIFICA STOCK', 'COMPRA', 'MOVIMIENTO SUCURSAL', 'INVENTARIO INICIAL', 'DEVOLUCION', 'BAJA']);
            $table->string('document')->nullable();
            $table->json('series')->nullable();

            $table->foreignId('branch_product_id')
                ->constrained('branch_product')
                ->onUpdate('cascade');

            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardex');
    }
}
