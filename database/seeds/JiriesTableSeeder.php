<?php

use Illuminate\Database\Seeder;

class JiriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\Jiri::create([
            'name' => 'jury janvier 2019',
            'user_id' => '1'
        ])
        ;\jiri\Jiri::create([
            'name' => 'jury janvier 2019',
            'user_id' => '2'
        ]);
        \jiri\Jiri::create([
            'name' => 'jury juin 2019',
            'user_id' => '1'
        ]);
        \jiri\Jiri::create([
            'name' => 'jury juin 2019',
            'user_id' => '2'
        ]);
    }
}
