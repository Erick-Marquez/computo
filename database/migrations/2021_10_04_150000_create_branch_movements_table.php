<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_movements', function (Blueprint $table) {
            $table->id();
            $table->string('observation')->nullable();
            $table->date('date')->nullable(); // FECHA DE EMISION

            $table->foreignId('branch_origin_id') 
                ->constrained('branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('branch_destination_id') 
                ->constrained('branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('user_id')
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
        Schema::dropIfExists('branch_movements');
    }
}
