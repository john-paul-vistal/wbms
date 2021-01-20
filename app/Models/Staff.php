<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $fillable = [
        'username',
        'password',
        'firstName',
        'lastName',
        'gender',
        'usertype',
        'email',
        'address'
        ];
        
        protected $hidden = [
        'password'
        ];

}
