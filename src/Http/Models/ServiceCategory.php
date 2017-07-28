<?php

namespace A4fteam\Admpanel\Http\Models;
use Cviebrock\EloquentSluggable\Sluggable;

class ServiceCategory extends Model
{
    use Sluggable;

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name',
                'save_to'    => 'slug',
                'unique'     => true,
            ]
        ];
    }
    
    protected $table = 'service_category';
     
   protected $fillable = [
         'name', 'description', 'is_active', 'slug', 'seo_title', 'seo_description', 'seo_keywords'
    ];
   public function service()
    {
    	return $this->hasMany('A4f\Admpanel\Http\Models\Service');
    }
    
     public static function i()
    {
        $class = get_called_class();
        if (!static::$_instance) {
            static::$_instance = new $class();
        }

        return static::$_instance;
    }
    
     public function posts()
    {
        return $this->hasMany(Posts::class, 'category_id');
    }

    public function withPostsCount()
    {
        $class = get_called_class();

        return $class::leftJoin('posts', 'posts.category_id', '=', 'categories.id')
            ->where('posts.status', 'active')
            ->groupBy('categories.id')
            ->orderBy('categories.name')
            ->get(['categories.*', DB::raw('COUNT(posts.id) as num')]);
    }

    public function allWithPostsCount()
    {
        return static::leftJoin('posts', 'posts.category_id', '=', 'categories.id')
            ->groupBy('categories.id')
            ->orderBy('categories.name')
            ->get(['categories.*', DB::raw('COUNT(posts.id) as num')]);
    }

    public function getBySlug($slug)
    {
        return static::where('slug', 'like', $slug)->first();
    }
}
