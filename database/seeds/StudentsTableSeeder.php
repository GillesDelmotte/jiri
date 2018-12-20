<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\Student::create([
            'name' => 'Marvin Lemarchand',
            'email' => 'marvin.lemarchand@outlook.be'
        ]);

        \jiri\Student::create([
            'name' => 'Cédric Muller',
            'email' => 'cedric.muller@outlook.be'
        ]);
    }
}
