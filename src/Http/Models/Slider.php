<?php

namespace A4fteam\Admpanel\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
     
   protected $fillable = [
         'img_name',  'is_active', 'alt'
    ];
}
