<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('serie'); //B001
            $table->boolean('active')->default(true);
            $table->bigInteger('current_number'); // 11

            $table->string('voucher_type_id'); // BOLETA

            $table->foreign('voucher_type_id')
                ->references('id')
                ->on('voucher_types') 
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('branch_id') // PRINCIPAL
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
        Schema::dropIfExists('series');
    }
}
