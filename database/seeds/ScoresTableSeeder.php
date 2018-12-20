<?php

use Illuminate\Database\Seeder;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \jiri\Score::create([
            'implement_id' => 1,
            'user_id' => 1,
            'score' => 15,
            'comment' => 'très bon travail de la par de Gilles Delmotte je dirais meme plus, parfait'
        ]);
        \jiri\Score::create([
            'implement_id' => 1,
            'user_id' => 2,
            'score' => 14,
            'comment' => 'très bon travail de la par de Gilles Delmotte je dirais meme plus, parfait'
        ]);
    }
}
