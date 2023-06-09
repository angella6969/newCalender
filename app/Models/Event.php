<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function event()
    {
        return $this->belongsToMany(User::class);
    }
    public function eventPerjalanan()
    {
        return $this->hasMany(userPerjalanan::class);
    }
}
