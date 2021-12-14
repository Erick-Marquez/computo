<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoidedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voideds', function (Blueprint $table) {
            $table->id();

            $table->date('date_issue')->nullable();
            $table->date('date_reference')->nullable();

            $table->string('identifier');
            $table->string('ticket_number')->nullable();
            $table->string('description');

            // $table->string('path_xml')->nullable();
            // $table->string('path_cdr')->nullable();
            // $table->string('external_id')->nullable(); //uuid para descargas

            $table->string('state')->nullable();
            $table->boolean('send_sunat')->default(false);
            $table->boolean('response_sunat')->default(false);
            $table->text('description_sunat_cdr')->nullable();
            $table->string('hash_cdr')->nullable();
            $table->string('hash_cpe')->nullable();

            $table->unsignedBigInteger('sale_id')->unique();
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onUpdate('cascade');

            $table->foreignId('user_id')
                ->constrained()
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
        Schema::dropIfExists('voideds');
    }
}
