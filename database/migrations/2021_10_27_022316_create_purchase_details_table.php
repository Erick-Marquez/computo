<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();

            $table->decimal('price', 12, 3);
            $table->bigInteger('quantity');

            $table->decimal('total_igv', 12, 3)->default(0);
            $table->unsignedDecimal('subtotal', 12, 3)->nullable();
            $table->unsignedDecimal('total', 12, 3)->nullable();
            $table->json('series')->nullable();

            $table->foreignId('purchase_id')
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
        Schema::dropIfExists('purchase_details');
    }
}
