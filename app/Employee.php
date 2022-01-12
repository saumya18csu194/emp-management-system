<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ["full_name", "email", "age"];
    public function scopeSearch($query,$s)
    {
        return $query->where('full_name','like','% .$s. %');
    }
}
