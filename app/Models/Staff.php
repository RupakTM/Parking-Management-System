<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'staffs';
    protected $fillable = ['name','email','address','phone','image','status','created_by','updated_by'];

    function user(){
        return $this->belongsTo(User::class);
    }
}
