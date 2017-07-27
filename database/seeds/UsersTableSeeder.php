<?php

use Illuminate\Database\Seeder;
use A4f\Admpanel\Src\Http\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            User::create([
                'name'           => 'Admin',
                'email'          => 'test@mail.ru',
                'password'       => bcrypt('013666'),
                'remember_token' => str_random(60),
                'role'           => 'admin',
                'active'         => '1',
            ]);
        }
    }
}
