<?php

namespace jiri;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Jiri extends Model
{
    protected $table = 'jiries';

    protected $fillable = ['name', 'user_id', 'scheduled_on'];

    public function judges()
    {
        return $this->morphedByMany(User::class, 'person');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->morphedByMany(Student::class, 'person');
    }

    public function getCreatedDateAttribute(){
        $d = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $d->isoFormat('LLLL');
    }

    public function impressions(){
        return $this->hasMany(Impression::class);
    }
}
