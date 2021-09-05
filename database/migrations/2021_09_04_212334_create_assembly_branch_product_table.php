<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyBranchProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assembly_branch_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assembly_id') 
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('branch_product_id') 
                ->constrained('branch_product')
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
        Schema::dropIfExists('assembly_branch_product');
    }
}
