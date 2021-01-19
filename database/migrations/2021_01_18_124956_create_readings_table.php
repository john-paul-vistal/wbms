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
            $table->unsignedBigInteger('recordedBy'); //foreign key   //userID
            $table->unsignedBigInteger('customer_id'); //foreign key //customerName
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('recordedBy')->references('id')->on('staffs')->onDelete('cascade');
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
