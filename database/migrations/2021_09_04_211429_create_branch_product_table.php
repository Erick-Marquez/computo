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
            $table->unsignedDecimal('referential_purchase_price', 9, 3)->nullable();
            $table->unsignedDecimal('sale_gain_one', 9, 3)->nullable();
            $table->unsignedDecimal('sale_gain_two', 9, 3)->nullable();
            $table->unsignedDecimal('sale_gain_three', 9, 3)->nullable();
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
