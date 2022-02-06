<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenClosedCashboxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_closed_cashbox_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('amount', 9, 3);
            $table->enum('type', ['INGRESO', 'EGRESO', 'REMUNERACION']); // EGRESO
            $table->string('observation')->nullable();

            $table->foreignId('open_closed_cashbox_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('payment_type_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('SET NULL');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('SET NULL');

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
        Schema::dropIfExists('open_closed_cashbox_details');
    }
}
