<?php

namespace A4fteam\Admpanel\Http\Models;

class Service extends Model
{
    protected $table = 'services';
     
   protected $fillable = [
         'name', 'category_id', 'price_from', 'price_to', 'note', 'meta_title', 'meta_description', 'meta_keywords', 'is_active'
    ];
   public function category()
    {
    	return $this->belongsTo('A4f\Admpanel\Http\Models\ServiceCategory');
    }
}
