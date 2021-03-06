<?php

namespace jiri;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = ['name', 'email'];

    public function implementations(){
        return $this->hasMany(Implement::class);
    }

    public function implementationsForCurrentJiri(){
        return $this->hasMany(Implement::class)
            ->where('jiri_id', session('jiri_id'));
    }

    public function implementationsForCurrentJiriWithProjects(){
        return $this->hasMany(Implement::class)
            ->with(['project'])
            ->where('jiri_id', session('jiri_id'));

    }

    public function implementationsForCurrentJiriWithProjectsAndScore(){
        return $this->hasMany(Implement::class)
            ->with(['project', 'scoreForCurrentUser'])
            ->where('jiri_id', session('jiri_id'));
    }

    public function implementationsForCurrentJiriWithProjectsAndScores(){
        return $this->hasMany(Implement::class)
            ->with(['project', 'scores'])
            ->where('jiri_id', session('jiri_id'));
    }


    public function impressions(){
        return $this->hasMany(Impression::class);
    }


}
