<?php

function user($id)
{
	$user = App\User::on('mysql2')->where('id',$id)->first();

	return $user;
}
function username($id)
{
	$user = App\User::on('mysql2')->where('id',$id)->first();

	if(is_object($user)){
		return $user->name;	
	}else{
		return '-';
	}

	
}
function useremail($email)
{
	$user = App\User::on('mysql2')->where('email',$email)->first();

	return $user;
}
function country()
{
	
	$countries = App\Models\Countries::on('mysql2')->get();

	return $countries;
}

function currency($type)
{
	if($type == 4)
	{
		$currency = 'USD';
	}else if($type == 5){
		$currency = 'TRY';	
	}else {
		$currency = 'EUR';
	}
	return $currency;
}

function bank($id)
{
	$bank = App\Models\Bank::on('mysql2')->where('id',$id)->first(); 
	
	return $bank;
}

function country_name($id)
{
	$countries = App\Models\Countries::on('mysql2')->where('id',$id)->first();

	return $countries;
}

function humanTiming ($time)
{
	$time = time() - $time;
	$time = ($time < 1)? 1 : $time;
	$tokens = array (
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'min',
		1 => 'sec'
	);
	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits.' '.$text.(($numberOfUnits > 1) ? 's' : '');
	}
}

function userBalance($id,$coin)
{
	$user = App\Models\UserWallet::on('mysql2')->where('user_id',$id)->where('currency',$coin)->first();
	if(isset($user->balance))
	{
		return number_format($user->balance,8);
	}
	else
	{
		return number_format(0,8);
	}
	
}

function markertBuyPrice($id)
{
	$buy = App\Models\CompletedTrade::on('mysql2')->where('buytrade_id',$id)->first();

	return $buy;
}

function markertSellPrice($id)
{
	$sell = App\Models\CompletedTrade::on('mysql2')->where('selltrade_id',$id)->first();

	return $sell;
}


    function time_Ago($time) { 

    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff    = time() - $time; 
    
    // Time difference in seconds 
    $sec     = $diff; 
    
    // Convert time difference in minutes 
    $min     = round($diff / 60 ); 
    
    // Convert time difference in hours 
    $hrs     = round($diff / 3600); 
    
    // Convert time difference in days 
    $days    = round($diff / 86400 ); 
    
    // Convert time difference in weeks 
    $weeks   = round($diff / 604800); 
    
    // Convert time difference in months 
    $mnths   = round($diff / 2600640 ); 
    
    // Convert time difference in years 
    $yrs     = round($diff / 31207680 ); 
    
    // Check for seconds 
    if($sec <= 60) { 
        return "$sec seconds ago"; 
    } 
    
    // Check for minutes 
    else if($min <= 60) { 
        if($min==1) { 
            return "one minute ago"; 
        } 
        else { 
            return "$min minutes ago"; 
        } 
    } 
    
    // Check for hours 
    else if($hrs <= 24) { 
        if($hrs == 1) { 
            return "an hour ago"; 
        } 
        else { 
            return "$hrs hours ago"; 
        } 
    } 
    
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            return "Yesterday"; 
        } 
        else { 
            return "$days days ago"; 
        } 
    } 
    
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            return "a week ago"; 
        } 
        else { 
            return "$weeks weeks ago"; 
        } 
    } 
    
    // Check for months 
    else if($mnths <= 12) { 
        if($mnths == 1) { 
            return "a month ago"; 
        } 
        else { 
            return "$mnths months ago"; 
        } 
    } 
    
    // Check for years 
    else { 
        if($yrs == 1) { 
            return "one year ago"; 
        } 
        else { 
            return "$yrs years ago"; 
        } 
    } 
}


