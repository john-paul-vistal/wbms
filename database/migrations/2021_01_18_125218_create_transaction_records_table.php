<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_records', function (Blueprint $table) {
            $table->id();
            $table->integer('reading_id')->unsigned(); //foreign key
            $table->float('amount_rendered');
            $table->integer('transactedBy')->unsigned(); // foreign key
            $table->timestamps();

            $table->foreign('reading_id')->references('id')->on('readings');
            $table->foreign('transactedBy')->references('id')->on('staffs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_records', function(Blueprint $table){
            $table->dropForeign('reading_id');
            $table->dropForeign('transactedBy');
        });
    }
}
