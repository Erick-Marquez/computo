<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('document_number');
            $table->date('date_issue')->nullable(); // FECHA DE EMISION
            $table->date('date_due')->nullable(); // FECHA VENCIMIENTO

            $table->unsignedDecimal('global_discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('item_discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('total_discount', 12,3)->nullable()->default(0);
            $table->unsignedDecimal('total', 12,3)->default(0);

            // $table->string('state')->nullable();

            $table->foreignId('serie_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('sale_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('customer_id')
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
        Schema::dropIfExists('warranties');
    }
}
