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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('username',50)->unique();
            $table->string('password',50);
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('gender',50);
            $table->string('usertype',50);
            $table->string('email',80);
            $table->integer('contactNumber')->unassigned();
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
        Schema::dropIfExists('staff');
    }
}
