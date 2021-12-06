<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->bigInteger('document_number');
            $table->string('serie');
            $table->decimal('exchange_rate')->nullable();
            $table->date('date_issue')->nullable(); // FECHA DE EMISION
            $table->unsignedDecimal('subtotal', 12, 3)->nullable();
            $table->decimal('total_igv', 12, 3)->default(0);
            // $table->decimal('total_exonerated', 12, 3)->default(0);
            // $table->decimal('total_unaffected', 12, 3)->default(0);
            // $table->decimal('total_free', 12, 3)->default(0);
            // $table->decimal('total_taxed', 12, 3)->default(0);
            $table->unsignedDecimal('total', 12, 3)->default(0);
            $table->boolean('has_debt')->default(false);
            $table->string('observation')->nullable();

            $table->foreignId('provider_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('open_closed_cashbox_id')->nullable()
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
        Schema::dropIfExists('purchases');
    }
}
