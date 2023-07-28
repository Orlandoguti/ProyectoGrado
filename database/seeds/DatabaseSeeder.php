<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'orlandoguti698@gmail.com',
            'password' => bcrypt('123456'),
            'idrol' => '1',
            'id' => '1',
            'condicion' => '1',
        ]);
    }
}
