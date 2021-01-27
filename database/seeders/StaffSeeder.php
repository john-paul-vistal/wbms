<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\Staff;
class StaffSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            'firstName' => "super",
            'lastName' => "admin",
            'username'=> "sadmin000",
            'password'=>"P@ssw0rd",
            'middleName' => "sample",
            'gender'=> "male",
            'usertype'=> "ADMIN",
            'email'=> "sample@gmail.com",
            'contactNumber'=> "00000000000",
            'address'=> "Poblacion, Sagbayan, Bohol"
        ]);
    }
}
