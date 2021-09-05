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
            $table->unsignedDecimal('price', 9,3)->nullable();
            $table->boolean('manager_series')->default(false);
            $table->boolean('active')->default(true);

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
