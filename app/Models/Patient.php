<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $guarded = [];
    protected $dates=['date_of_birth',];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->hasMany(Report::class);
    }
}
