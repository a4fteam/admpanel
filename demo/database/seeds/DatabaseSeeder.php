<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();	
           $this->call(UsersTableSeeder::class);
	   $this->call(PagesTableSeeder::class);
	   $this->call(MenuTableSeeder::class);
           $this->call(Service_CategoryTableSeeder::class);
           $this->call(TagsTableSeeder::class);
           $this->call(PostsTableSeeder::class);
           $this->call(Service_CategoryTableSeeder::class);	   
	Model::reguard();
    }
}
