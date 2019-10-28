<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $guarded = [''];
    public $timestamps=false;

    public function day()
    {
        return $this->belongsTo(Days::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
