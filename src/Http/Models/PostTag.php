<?php

namespace A4fteam\Admpanel\Src\Http\Models;

class PostTag extends Model
{
    protected $table = 'post_tag';
    public static $_instance = null;

    public static function i()
    {
        $class = get_called_class();
        if (!static::$_instance) {
            static::$_instance = new $class();
        }

        return static::$_instance;
    }
}