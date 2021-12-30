<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document')->unique()->index();
            $table->string('tradename')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('identification_document_id');


            $table->foreign('identification_document_id')
                ->references('id')
                ->on('identification_documents')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('ubigee_id') // PRINCIPAL
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('SET NULL');

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
        Schema::dropIfExists('providers');
    }
}
