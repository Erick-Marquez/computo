<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('ruc')->nullable();
            $table->string('name')->nullable();
            $table->string('comercial_name')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();

            $table->string('ubigeo', 6)->nullable();
            $table->string('urbanization')->nullable();
            $table->string('address')->nullable();
            

            $table->string('user_sol')->nullable();
            $table->string('password_sol')->nullable();

            $table->boolean('demo')->default(false); // Si esta en demo true
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
        Schema::dropIfExists('company');
    }
}
