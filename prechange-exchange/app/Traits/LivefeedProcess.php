<?php 

namespace App\Traits;
use App\Models\Transaction;
trait LivefeedProcess {


	public static function getBuyFeed($buyLists)
    {
        
         $details=[   
                    'price' => $buyLists->price,
                    'volume' => $buyLists->volume,
                    'value' => $buyLists->value,
                    
                  ];         
             
        return $details;
    }
    
    
    public static function getSellFeed($sellLists)
    {

        $details=[   
                        'price' => $sellLists->price,
                        'volume' => $sellLists->volume,
                        'value' => $sellLists->value,
              ];            

        return $details;
    }

    public static function getBuyUsdEthFeed($buyLists)
    {

        $details=[   
                        'price' => $buyLists->price,
                        'volume' => $buyLists->volume,
                        'value' => $buyLists->value,
              ];            

        return $details;
    }

    public static function getSellUsdEthFeed($sellLists)
    {

        $details=[   
                        'price' => $sellLists->price,
                        'volume' => $sellLists->volume,
                        'value' => $sellLists->value,
              ];            

        return $details;
    }

    public static function getBuyBtcLtcFeed($buyLists)
    {

        $details=[   
                        'price' => $buyLists->price,
                        'remaining' => $buyLists->remaining,
                        'value' => $buyLists->price * $buyLists->remaining,
              ];            

        return $details;
    }

    public static function getSellBtcLtcFeed($sellLists)
    {

        $details=[   
                        'price' => $sellLists->price,
                        'remaining' => $sellLists->remaining,
                        'value' => $sellLists->price * $sellLists->remaining,
              ];            

        return $details;
    }

    public static function getBuyBtcEthFeed($buyLists)
    {

        $details=[   
                        'price' => $buyLists->price,
                        'remaining' => $buyLists->remaining,
                        'value' => $buyLists->price * $buyLists->remaining,
              ];            

        return $details;
    }

    public static function getSellBtcEthFeed($sellLists)
    {

        $details=[   
                        'price' => $sellLists->price,
                        'remaining' => $sellLists->remaining,
                        'value' => $sellLists->price * $sellLists->remaining,
              ];            

        return $details;
    }

    
    
    
 }