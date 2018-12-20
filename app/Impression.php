<?php

namespace jiri;

use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    protected $fillable = ['impression_score', 'impression_comment', 'jiri_id', 'student_id', 'user_id'];

    public function judge(){
        return $this->belongsTo(User::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function jiri(){
        return $this->belongsTo(Jiri::class);
    }

}
