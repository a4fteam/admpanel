<?php

use Illuminate\Database\Seeder;
use A4f\Admpanel\Src\Http\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Menu::firstOrCreate([
            'parent_id' => '0',
            'page_id' => '1',
            'position' => 'top',
            'title' => 'Главная',
            'url' => '/',
            'active_item' => 'Index',
            'sort' => '100',
        ]);
    }
}
