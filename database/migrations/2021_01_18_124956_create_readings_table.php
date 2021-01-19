<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->float('cubic');
            $table->integer('recordedBy')->unsigned(); //foreign key   //userID
            $table->integer('customer_id')->unsigned(); //foreign key //customerName
            $table->date();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('recordedBy')->references('id')->on('staffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readings', function(Blueprint $table){
            $table->dropForeign('customer_id');
            $table->dropForeign('recordedBy');
        });
    }
}
