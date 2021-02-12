<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminJadaxTransaction extends Model
{
   public static function deposit()
   {
   		$list  = AdminJadaxTransaction::where('type','received')->paginate(15);

   		return $list;
   }

   public static function withdraw()
   {
   		$list  = AdminJadaxTransaction::where('type','send')->paginate(15);

   		return $list;
   }
}