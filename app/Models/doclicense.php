<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doclicense extends Model
{
    protected $guarded=[''];
    public $timestamps =false;
    public function doc()
    {
        return $this->hasOne(Doctor::class);
    }
}
