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
            'user_id' => '1',
            'scheduled_on' => '2019-04-22 08:20:00'
        ])
        ;\jiri\Jiri::create([
            'name' => 'jury janvier 2019',
            'user_id' => '2',
            'scheduled_on' => '2019-04-22 08:20:00'
        ]);
        \jiri\Jiri::create([
            'name' => 'jury juin 2019',
            'user_id' => '1',
            'scheduled_on' => '2019-04-22 08:20:00'
        ]);
        \jiri\Jiri::create([
            'name' => 'jury juin 2019',
            'user_id' => '2',
            'scheduled_on' => '2019-04-22 08:20:00'
        ]);
    }
}
