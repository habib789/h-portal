<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function license()
    {
        return $this->hasOne(doclicense::class);
    }
}
