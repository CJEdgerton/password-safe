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
    	App\User::create([
    		'name' => 'Darth Vader',
    		'email'=> 'vader@deathstar.com',
    		'password' => bcrypt('password'),
    	]);

        factory('App\User', 10)->create();
    }
}
