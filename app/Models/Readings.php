<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readings extends Model
{
    use HasFactory;

    public $fillable=[
        'amount',
        'cubic',
        'recordedBy',
        'customer_id',
        'due_date'
    ];


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id' , 'id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'recordedBy' , 'id');
    }
}
