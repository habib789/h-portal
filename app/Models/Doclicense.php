<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doclicense extends Model
{
    protected $guarded=[''];
    public function doc()
    {
        return $this->belongsTo(Doctor::class);
    }
}
