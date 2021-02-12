<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminXrpTransaction extends Model
{
    public static function deposit()
   {
   		$list  = AdminXrpTransaction::where('type','received')->orderBy('id','desc')->paginate(15);

   		return $list;
   }

   public static function withdraw()
   {
   		$list  = AdminXrpTransaction::where('type','send')->orderBy('id','desc')->paginate(15);

   		return $list;
   }
}
