<?php

use Illuminate\Database\Seeder;

class ImplementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\Implement::create([
            'student_id' => 1,
            'project_id' => 1,
            'jiri_id' => 1
        ]);
        \jiri\Implement::create([
            'student_id' => 1,
            'project_id' => 2,
            'jiri_id' => 1
        ]);
        \jiri\Implement::create([
            'student_id' => 2,
            'project_id' => 1,
            'jiri_id' => 1
        ]);
    }
}
