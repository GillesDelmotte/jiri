<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\People::create([
            'jiri_id' => 1,
            'person_id' => 1,
            'person_type' => jiri\User::class
        ]);
        \jiri\People::create([
            'jiri_id' => 1,
            'person_id' => 1,
            'person_type' => jiri\Student::class
        ]);
        \jiri\People::create([
            'jiri_id' => 2,
            'person_id' => 2,
            'person_type' => jiri\User::class
        ]);
        \jiri\People::create([
            'jiri_id' => 1,
            'person_id' => 2,
            'person_type' => jiri\Student::class
        ]);
    }
}
