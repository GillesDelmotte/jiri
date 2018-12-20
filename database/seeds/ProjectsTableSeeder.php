<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\Project::create([
            'name' => 'jiri',
            'description' => 'Creer une application pour aider la creation d‘un jury'
        ]);
        \jiri\Project::create([
            'name' => 'pfe',
            'description' => 'Creation d‘une application en vue/laravel'
        ]);
    }
}
