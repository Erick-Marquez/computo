<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('document_number');
            $table->date('date_issue')->nullable(); // FECHA DE EMISION
            $table->date('date_due')->nullable(); // FECHA VENCIMIENTO

            $table->unsignedDecimal('discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('subtotal', 12,3)->default(0);
            $table->unsignedDecimal('total_igv', 12,3)->default(0);
            $table->unsignedDecimal('total_exonerated', 12,3)->default(0);
            $table->unsignedDecimal('total_unaffected', 12,3)->default(0);
            $table->unsignedDecimal('total_free', 12,3)->default(0);
            $table->unsignedDecimal('total_taxed', 12,3)->default(0);
            $table->unsignedDecimal('total', 12,3)->default(0);

            $table->boolean('have_warranty')->default(false);

            $table->text('observation')->nullable();
            $table->unsignedDecimal('received_money', 12,3)->nullable();
            $table->unsignedDecimal('change', 12,3)->nullable();

            $table->string('state')->nullable();
            $table->boolean('send_sunat')->default(false);
            $table->boolean('response_sunat')->default(false);
            $table->text('description_sunat_cdr')->nullable();
            $table->string('hash_cdr')->nullable();
            $table->string('hash_cpe')->nullable();
            $table->boolean('canceled')->default(false);

            $table->foreignId('serie_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('customer_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('open_closed_cashbox_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');    

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
        Schema::dropIfExists('sales');
    }
}
