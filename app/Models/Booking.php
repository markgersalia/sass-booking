<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
     protected $fillable = [
        'user_id',     // who booked
        'listing_id',  // which listing
        'start_time',
        'end_time',
        'status',      // pending, confirmed, canceled, completed
        'notes',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function listing(){
        return $this->belongsTo('App\Models\Listing');
    }
}
