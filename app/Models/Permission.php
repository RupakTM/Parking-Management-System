<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = ['module_id','name','route','status','created_by','updated_by'];

    function module(){
        return $this->belongsTo(Module::class,'module_id');
    }

    function roles(){
        return $this->belongsToMany(Role::class);
    }

    function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
//    function permissions(){
//        return $this->hasMany(Permission::class);
//    }
}
