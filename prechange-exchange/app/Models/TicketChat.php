<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketChat extends Model
{
	 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'reply'
    ];

	public function ticketDetails()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id', 'id');
    }
	
   
    public function userDetails()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}
