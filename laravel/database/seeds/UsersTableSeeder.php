<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@local',
            'password' => bcrypt('123456'),
        ]);

        DB::table('info')->insert([
            'text' => 'content'
        ]);


    }
}
