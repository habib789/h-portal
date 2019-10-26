<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    protected $guarded=[];
    public $timestamps=false;

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }
}
