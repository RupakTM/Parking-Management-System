<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = ["created_at"]; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set

    protected $table = 'parkings';
    protected $fillable = ['car_no','parking_slot_no','customer_name','bill_no','entry_time','exit_time','status','hour','price','created_by'];
    function customers(){
        return $this->belongsToMany(Customer::class);
    }
    function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
    function parkingslotNumber(){
        return $this->hasOne(ParkingSlot::class,'number');
    }
}
