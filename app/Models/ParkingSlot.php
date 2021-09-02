<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSlot extends Model
{
    use HasFactory;

    protected $table = 'parking_slots';
    protected $fillable = ['number','status','created_by','updated_by'];

    function user(){
        return $this->belongsTo(User::class);
    }
}
