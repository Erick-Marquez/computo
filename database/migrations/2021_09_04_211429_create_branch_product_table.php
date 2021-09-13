<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_product', function (Blueprint $table) {
            $table->id();
            //$table->string('cod')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->unsignedDecimal('referential_purchase_price', 9,3)->nullable();
            $table->unsignedDecimal('sale_price', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_one', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_two', 9,3)->nullable();
            $table->boolean('manager_series')->default(false);
            $table->boolean('active')->default(true);

            $table->foreignId('igv_type_id') 
                ->constrained('igv_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('product_id') 
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('branch_id') 
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
        Schema::dropIfExists('branch_product');
    }
}
