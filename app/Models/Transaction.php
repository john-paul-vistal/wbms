<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $fillable= [
        'customer_id',
        'meterReading',
        'total_amount',
        'rendered_amount',
        'change',
        'reading_date',
        'due_date',
        'status',
        'recordedBy',
        'transactedBy',
        'ispaid'
    ];


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id' , 'id');
    }

    public function recordedBy(){
        return $this->belongsTo(Staff::class, 'recordedBy' , 'id');
    }

    public function transactedBy(){
        return $this->belongsTo(Staff::class, 'transactedBy' , 'id');
    }


}
