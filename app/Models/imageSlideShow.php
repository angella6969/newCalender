<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageSlideShow extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function event()
    {
        return $this->belongsTo(EventSPPD::class, 'event_id');
    }
    
}
