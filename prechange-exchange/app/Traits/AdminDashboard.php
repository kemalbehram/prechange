<?php 
namespace App\Traits;

use App\User;
use App\Kyc;
use App\Ticket;
use Carbon\Carbon;
use App\Buytrade;
use App\Selltrade;

trait AdminDashboard {

	function getUsercount()
    {
        $count = User::count();
        return $count;
    }

    function getKycCount()
    {

        $kycCount = Kyc::count();
        return $kycCount;  
    }

    function getTicketsCount()
    {

        $kycCount = Ticket::count();
        return $kycCount;  
    }

    function getTodayUsercount()
    {
        $today = Carbon::now()->format('Y-m-d').'%';

        $todatUserCount = User::where('created_at', 'like', $today)->count();
        return $todatUserCount;  
    }

    function getTotalBuy()
    {

        $buyTradeCount = Buytrade::count();
       
        return $buyTradeCount;  
    }

    function getTotalSell()
    {

        $sellTradeCount = Selltrade::count();
       
        return $sellTradeCount;  
    }

    function getLastFiveTrades()
    {
        $buyTrades = Buytrade::orderBy('id', 'DESC')->take('5')->get();
        return $buyTrades;

    }

    
 }