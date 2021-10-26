<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitNoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_note_details', function (Blueprint $table) {
            $table->id();

            $table->decimal('price', 12, 3);
            $table->bigInteger('quantity');
            
            $table->decimal('total_igv', 12, 3)->default(0);
            $table->unsignedDecimal('subtotal', 12, 3)->nullable();
            $table->unsignedDecimal('total', 12, 3)->nullable();;
            //$table->unsignedDecimal('discount', 12, 3)->nullable();
            $table->string('igv_type_id');


            $table->foreign('igv_type_id')
                ->references('id')
                ->on('igv_types') 
                ->onUpdate('cascade');

            $table->foreignId('debit_note_id')
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
        Schema::dropIfExists('debit_note_details');
    }
}
