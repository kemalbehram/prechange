<?php 

   function display_format($number,$digit=8,$format=NULL){
        if($format ==""){
            $twocoin = sprintf('%.'.$digit.'f',$number);
        }elseif($format==0){
            $twocoin = number_format($number,$digit);
        }else{
            $twocoin = number_format($number,$digit,",",".");
        }
        return $twocoin;
    }

function username($id)
{
	$user = App\User::where('id',$id)->first();
	return $user->fname.$user->lname;
}

function useraddress($coin)
{
    if($coin == 'BTC'){

        $address = App\Models\UserBtcAddress::where('user_id',Auth::user()->id)->first();

        return $address->address;

    }elseif($coin == 'ETH'){

           $address = App\Models\UserEthAddress::where('user_id',Auth::user()->id)->first();

        return $address->address;

    }else{

         $address = App\Models\UserEthAddress::where('user_id',Auth::user()->id)->first();

        return $address->address;

    }
}

function bankname($id)
{
	$user = App\Banks::where('id',$id)->first();	
	return $user->bank;
}

function userbalance($currency)
{
	$user = App\UserWallet::where('user_id',Auth::id())->where('currency',$currency)->first();	
	return $user;
}

function last_Prices($pairCount)
    {
        
            $lastPrice = App\CompleteTrade::where('pair',$pairCount)->orderby('id','desc')->first();
            if(isset($lastPrice->price))
            { 
                $last_price=$lastPrice->price;            
            } 
            else    
            {
                $last_price = 0;
            }
       
        return $last_price;
    }

    function hrVolume($pairCount)
    {        
            $bid =App\CompleteTrade::where('pair', $pairCount)->where('created_at','>',Carbon\Carbon::now()->subDay(1))->orderBy('id', 'asc')->sum('volume'); 
            if($bid !=null)
            { 
                $hrVolume = $bid;
            }
            else
            {
                $hrVolume = 0;
            }
        
        return $hrVolume;
    }

    function hrExchange($i)
      {   
        $price =0.000; 
  
            $last = App\CompleteTrade::where('pair', $i)->orderBy('id', 'desc')->whereDate('created_at',Carbon\Carbon::today())->first(); 
            $open = App\CompleteTrade::where('pair', $i)->where('created_at','>',Carbon\Carbon::now()->subDay(1))->orderBy('id', 'asc')->first();  
            
            if(!empty($last)  && !empty($open))
            {
                if($last->count() < 0)
                {
                    $last->price = 0;
                }

                if($open->count() < 0)
                {
                    $open->price = 0;
                }

                $lastprice=$last->price; 
                $openprice=$open->price; 
                $price=(number_format($lastprice,8)- number_format($open->price,8))/ number_format($lastprice,8);  

                $hrExchange = number_format($price*100,0); 
            }
            else
            {
                $hrExchange = 0; 
            } 
             
        return $hrExchange;  
    }