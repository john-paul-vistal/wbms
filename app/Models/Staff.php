<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Staff extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

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
