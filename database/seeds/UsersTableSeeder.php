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
        \jiri\User::create([
            'name' => 'Gilles Delmotte',
            'email' => 'gilles.delmotte@outlook.be',
            'password' => Hash::make('azerty'),
            'api_token' => str_random(60)
        ]);

        \jiri\User::create([
            'name' => 'Charlotte Toussaint',
            'email' => 'charlotte.toussaint@outlook.be',
            'password' => Hash::make('azerty'),
            'api_token' => str_random(60)
        ]);
    }
}
