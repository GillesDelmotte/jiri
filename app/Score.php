<?php

namespace jiri;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    protected $fillable = ['implement_id', 'user_id', 'score', 'comment'];

    public function implementation(){
        return $this->belongsTo(Implement::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
