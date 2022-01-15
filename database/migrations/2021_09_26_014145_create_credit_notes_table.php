<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('document_number');
            $table->date('date_issue')->nullable(); // FECHA DE EMISION
            $table->unsignedDecimal('subtotal', 12, 3)->nullable();
            $table->unsignedDecimal('discount', 12, 3)->nullable();
            $table->decimal('total_igv', 12,3)->default(0);
            $table->decimal('total_exonerated', 12, 3)->default(0);
            $table->decimal('total_unaffected', 12, 3)->default(0);
            $table->decimal('total_free', 12, 3)->default(0);
            $table->decimal('total_taxed', 12, 3)->default(0);
            $table->unsignedDecimal('total', 12, 3)->default(0);

            $table->string('observation')->nullable();

            $table->boolean('send_sunat')->default(false);
            $table->string('state')->nullable();
            $table->string('response_sunat')->default(false);
            $table->string('description_sunat_cdr')->nullable();
            $table->string('hash_cdr')->nullable();
            $table->string('hash_cpe')->nullable();
            $table->boolean('canceled')->default(false);
            
            $table->string('credit_note_type_id');
            $table->foreign('credit_note_type_id')
                ->references('id')
                ->on('credit_note_types') 
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('serie_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('sale_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreignId('open_closed_cashbox_id')->nullable()
                ->constrained()
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
        Schema::dropIfExists('credit_notes');
    }
}
