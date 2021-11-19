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
            $table->string('description')->nullable();
            $table->unsignedDecimal('referential_purchase_price', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_one', 9,3)->nullable();
            $table->unsignedDecimal('referential_sale_price_two', 9,3)->nullable();
            $table->boolean('manager_series')->default(false);
            $table->boolean('active')->default(true);

            $table->boolean('have_warranty')->default(false);
            $table->string('type_of_time_for_warranty')->nullable();
            $table->integer('time_of_warranty')->nullable();

            $table->string('igv_type_id');
            $table->foreign('igv_type_id')
                ->references('id')
                ->on('igv_types') 
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
