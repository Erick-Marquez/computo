<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cod')->nullable();
            $table->string('name');
            $table->string('description');
            $table->unsignedDecimal('referential_purchase_price', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_one', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_two', 9,3)->nullable();
            $table->boolean('active')->default(true);

            $table->foreignId('igv_type_id') 
                ->constrained('igv_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('brand_line_id') 
                ->constrained('brand_line')
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
        Schema::dropIfExists('products');
    }
}
