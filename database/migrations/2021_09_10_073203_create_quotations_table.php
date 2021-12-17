<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('document_number')->nullable();
            $table->date('date_due')->nullable(); // FECHA VENCIMIENTO

            $table->unsignedDecimal('discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('subtotal', 12,3)->default(0);
            $table->unsignedDecimal('total_igv', 12,3)->default(0);
            $table->unsignedDecimal('total_exonerated', 12,3)->default(0);
            $table->unsignedDecimal('total_unaffected', 12,3)->default(0);
            $table->unsignedDecimal('total_free', 12,3)->default(0);
            $table->unsignedDecimal('total_taxed', 12,3)->default(0);
            $table->unsignedDecimal('total', 12,3)->default(0);
            
            $table->boolean('have_warranty')->nullable()->default(false);

            $table->string('observation')->nullable();

            $table->unsignedBigInteger('sale_id')->nullable()->unique();
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onUpdate('cascade');

            $table->foreignId('serie_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreignId('customer_id')
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
        Schema::dropIfExists('quotations');
    }
}
