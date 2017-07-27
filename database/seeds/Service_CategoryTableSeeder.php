<?php

use Illuminate\Database\Seeder;
use A4f\Admpanel\Src\Http\Models\ServiceCategory;

class Service_CategoryTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = ServiceCategory::firstOrNew([
            'slug' => 'category-1',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Category 1',
                'description'       => 'Category 1',
                'seo_title'         => 'Category 1',
                'seo_keywords'      => 'Category 1',
                'seo_description'   => 'Category 1',
            ])->save();
        }

        $category = ServiceCategory::firstOrNew([
            'slug' => 'category-2',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Category 2',
                'description'       => 'Category 2',
                'seo_title'         => 'Category 2',
                'seo_keywords'      => 'Category 2',
                'seo_description'   => 'Category 2',
            ])->save();
        }
    }
}
