<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchProductSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_product_series', function (Blueprint $table) {
            $table->id();

            $table->string('serie');
            $table->boolean('sold')->default(false);
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('branch_product_series');
    }
}
