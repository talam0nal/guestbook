<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Nikolay',
            'email' => 'nikolay@mail.ru',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Ivan',
            'email' => 'ivan@post.ru',
            'password' => bcrypt('secret'),
        ]);

    }
}
