<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminGncTransaction extends Model
{
   public static function deposit()
   {
   		$list  = AdminGncTransaction::where('type','received')->orderBy('id','desc')->paginate(15);

   		return $list;
   }

   public static function withdraw()
   {
   		$list  = AdminGncTransaction::where('type','send')->orderBy('id','desc')->paginate(15);

   		return $list;
   }
}
