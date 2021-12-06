<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountToPayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_to_pay_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_to_pay_id')
                ->constrained('accounts_to_pay')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('payment_type_id')
                ->nullable()
                ->constrained('payment_types')
                ->onUpdate('cascade')
                ->onDelete('SET NULL');
            $table->decimal('amount');
            $table->date('date_issue');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_to_pay_details');
    }
}
