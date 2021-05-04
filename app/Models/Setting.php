<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = ['name','address','pan_no','reg_no','phone','logo','fav_icon','price_per_hour','created_by','updated_by'];

}
