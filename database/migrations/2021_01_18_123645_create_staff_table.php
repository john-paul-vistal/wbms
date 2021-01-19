<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('username',50)->unique();
            $table->string('password',50);
            $table->string('firstName',50);
            $table->string('lastName',50);
            $table->string('gender',50);
            $table->string('usertype',50);
            $table->string('email',80);
            $table->string('contactNumber',15);
            $table->string('address',150);
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
        Schema::dropIfExists('staffs');
    }
}
