<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSPPD extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function eventTouserPerjalanan()
    {
        return $this->belongsTo(userPerjalanan::class);
    }
}
