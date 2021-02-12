<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $table = 'kyc'; 

    protected $hidden = ['dob', 'city', 'address', 'country', 'id_type', 'id_number', 'id_exp', 'front_img', 'back_img'];

   
}
