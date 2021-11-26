<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_details', function (Blueprint $table) {
            $table->id();

            $table->date('date_due')->nullable(); // FECHA VENCIMIENTO
            
            $table->unsignedDecimal('discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('price', 12,3);
            $table->bigInteger('quantity');

            $table->unsignedDecimal('total', 12,3)->nullable();

            $table->json('series')->nullable();

            $table->foreignId('warranty_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('branch_product_id')
                ->constrained('branch_product')
                ->onUpdate('cascade');
            
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
        Schema::dropIfExists('warranty_details');
    }
}
