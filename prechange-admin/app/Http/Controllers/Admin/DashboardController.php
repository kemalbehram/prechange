<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Session;
use App\Models\User;
use App\Models\Security;
use App\Models\Admin;
use App\Models\History;
use App\Traits\Dashboard;
use App\Models\Commission;

use App\Models\BuyTrades;
use App\Models\SellTrades;

use App\Models\Withdraw;

use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;
use App\Models\UserXrpTransaction;

class DashboardController extends Controller
{
    use Dashboard;

	public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
    	$dashboard = User::dashboard();
        // $siteUserBalance = $this->siteUserBalance();       
        $siteUserBalance = '';       

        $income = $this->income();

        $coin_details = Commission::on('mysql2')->get();

        // foreach ($coin_details as $key => $value) {
            
        //     if($value->type == 'coin'){

        //         if($value->source == 'BTC'){
        //             $admin['withdraw'][$value->source] = UserBtcTransaction::AdminFee($value->source);
        //         }elseif($value->source == 'ETH'){
        //             $admin['withdraw'][$value->source] = UserEthTransaction::AdminFee($value->source);
        //         }elseif($value->source == 'XRP'){
        //             $admin['withdraw'][$value->source] = UserXrpTransaction::AdminFee($value->source);
        //         }elseif($value->source == 'LTC'){
        //             $admin['withdraw'][$value->source] = UserXrpTransaction::AdminFee($value->source);
        //         }
                
        //     }elseif($value->type == 'fiat'){
        //         $admin['withdraw'][$value->source] = Withdraw::AdminFee($value->source);
        //     }

        //     if($value->market_status == '0'){
        //         $admin['trade'][$value->source] = BuyTrades::AdminFee($value->source); 
                
        //      }else{
        //         $admin['trade'][$value->source] = SellTrades::AdminFee($value->source);
        //      }
        // }

        $admin['trade'] = (int)0;
        $admin['withdraw'] = (int)0;

        $history = History::take(10)->get();


       	return view('dashboard')->with('details',$dashboard)->with('siteUserBalance',$siteUserBalance)->with('income',$income)->with('coin_details',$coin_details)->with('history',$history)
                                ->with('admin_income',$admin);
    }

    public function security()
    {
    	return view('settings.security');
    }

    public function updateUsername(Request $request)
    {
        $update = Admin::updateUsername($request);

        return back()->with('status',$update);
    }

    public function changepassword(Request $request)
    {
        $update = Admin::changepassword($request);

        return back()->with('status',$update);
    }
}
