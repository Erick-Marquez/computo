<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditStockModificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('stock_modifications', function (Blueprint $table) {

            $table->bigInteger('quantity')->nullable()->after('date');
            $table->string('operation')->after('quantity');
            $table->json('series')->nullable()->after('operation');


            $table->foreignId('branch_product_id')->after('series')
                    ->constrained('branch_product')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('stock_modifications', function (Blueprint $table) {

            $table->dropColumn('quantity');
            $table->dropColumn('operation');
            $table->dropColumn('series');
            $table->dropForeign('stock_modifications_branch_product_id_foreign');
            $table->dropColumn('branch_product_id');

        });
    }
}
