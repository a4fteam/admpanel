<?php

namespace A4fteam\Admpanel\Src\Http\Models;

class Page extends Model
{
   protected $table = 'pages';
     
   protected $fillable = [
         'description', 'meta_title', 'meta_description', 'meta_keywords', 'is_active', 'title'
    ];
   public function menu()
    {
    	return $this->belongsTo('A4f\Admpanel\Src\Http\Models\Menu');
    }
}
