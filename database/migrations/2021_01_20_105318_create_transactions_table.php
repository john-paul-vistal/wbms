<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
           
            $table->id();
            $table->unsignedBigInteger('customer_id');//fk from customer
            $table->float('meterReading');
            $table->float('total_amount');
            $table->float('rendered_amount')->default(0.0);
            $table->float('change')->default(0.0);
            $table->date('reading_date');
            $table->date('due_date');
            $table->boolean('ispaid')->default(0);
            $table->unsignedBigInteger('recordedBy'); //fk from staff
            $table->unsignedBigInteger('transactedBy')->nullable(); //fk from staff
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('recordedBy')->references('id')->on('staffs');
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
        Schema::dropIfExists('transactions');
    }
}
