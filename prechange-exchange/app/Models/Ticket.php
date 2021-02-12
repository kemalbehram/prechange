<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function userDetails()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
