<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    protected $guarded = [];
    protected $dates=['date_of_birth',];
//    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function doclicense()
    {
        return $this->hasOne(doclicense::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function timeSlots(){
        return $this->hasMany(TimeSlot::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
