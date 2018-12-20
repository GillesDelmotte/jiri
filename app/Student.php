<?php

namespace jiri;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function implementations(){
        return $this->hasMany(Implement::class);
    }

    public function implementationsForCurrentJiri(){
        return $this->hasMany(Implement::class)
            ->where('jiri_id', 1);
    }

    public function implementationsForCurrentJiriWithProjects(){
        return $this->hasMany(Implement::class)
            ->with(['project'])
            ->where('jiri_id', 1);

    }

    public function implementationsForCurrentJiriWithProjectsAndScore(){
        return $this->hasMany(Implement::class)
            ->with(['project', 'scoreForCurrentUser'])
            ->where('jiri_id', 1);
    }

    public function impressions(){
        return $this->hasMany(Impression::class);
    }


}
