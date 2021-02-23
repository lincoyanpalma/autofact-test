<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'lincoyan.palma@gmail.com',
                'password' => bcrypt('123456'),
                'name' => 'Lincoyan Admin',
                'admin' => true
            ],
            [
                'id' => 2,
                'email' => 'lincoyanpalma@kimsasoftware.com',
                'password' => bcrypt('123456'),
                'name' => 'Lincoyan no Admin',
                'admin' => false
            ],
        ]);
    }
}
