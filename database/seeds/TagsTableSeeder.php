<?php

use Illuminate\Database\Seeder;
use A4f\Admpanel\Src\Http\Models\Tags;

class TagsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Tags::firstOrCreate([
            'tag' => 'test',
        ]);
    }
}
