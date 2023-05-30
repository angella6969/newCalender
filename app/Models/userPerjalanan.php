<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userPerjalanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userPerjalananToEvent()
    {
        return $this->hasMany(EventSPPD::class);
    }
    public function userPerjalananToUser()
    {
        return $this->hasMany(user::class);
    }
}
