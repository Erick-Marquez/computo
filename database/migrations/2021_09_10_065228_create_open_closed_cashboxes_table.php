<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenClosedCashboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_closed_cashboxes', function (Blueprint $table) {
            $table->id();
            $table->datetime('opening_date'); // FECHA DE APERTURA
            $table->unsignedDecimal('opening_amount', 9, 2); // MONTO DE APERTURA
            $table->datetime('closing_date')->nullable(); // FECHA DE CIERRE
            $table->unsignedDecimal('closing_amount', 9, 2)->nullable(); // MONTO DE CIERRE
            $table->boolean('state')->default(true); // CERRADO O ABIERTO

            $table->foreignId('user_id') // USUARIO
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('cashbox_id') // CAJA
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
        Schema::dropIfExists('open_closed_cashboxes');
    }
}
