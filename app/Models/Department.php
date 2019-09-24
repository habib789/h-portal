<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
