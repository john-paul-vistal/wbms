<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRecords extends Model
{
    use HasFactory;
    public $fillable = [
        'amount_rendered',
        'change',
        'reading_id',
        'transactedBy'
    ];
   

    public function reading(){
        return $this->belongsTo(Reading::class, 'reading_id' , 'id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'transactedBy' , 'id');
    }
}
