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
            $table->unsignedDecimal('subtotal', 12, 3)->nullable();
            $table->unsignedDecimal('discount', 12, 3)->nullable();
            $table->decimal('total_igv', 12,3)->default(0);
            $table->decimal('total_exonerated', 12, 3)->default(0);
            $table->decimal('total_unaffected', 12, 3)->default(0);
            $table->decimal('total_free', 12, 3)->default(0);
            $table->decimal('total_taxed', 12, 3)->default(0);
            $table->unsignedDecimal('total', 12, 3)->default(0);

            $table->boolean('have_warranty')->default(false);

            $table->string('observation')->nullable();
            $table->decimal('received_money', 9, 3)->nullable();
            $table->decimal('change', 9, 3)->nullable();

            $table->string('state')->nullable();
            $table->boolean('send_sunat')->default(false);
            $table->boolean('response_sunat')->default(false);
            $table->string('description_sunat_cdr')->nullable();
            $table->string('hash_cdr')->nullable();
            $table->boolean('canceled')->default(false);
            
            $table->foreignId('payment_type_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
