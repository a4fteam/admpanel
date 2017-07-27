<?php

namespace A4fteam\Admpanel\Src\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'main';
     
    protected $fillable = [
         'description', 'meta_title', 'meta_description', 'meta_keywords', 'is_active'
    ];
}
