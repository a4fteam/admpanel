<?php

namespace A4fteam\Admpanel\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
	protected $fillable = [
         'name', 'logo', 'is_active'
    ];
}
