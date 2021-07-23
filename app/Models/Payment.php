<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = ['customer_name','invoice_no','amount','payment_date','created_by'];

    function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

}
