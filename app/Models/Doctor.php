<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    protected $guarded = [];
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
}
