<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;
use App\Models\UserXrpTransaction;
use App\Models\CurrencyDeposit;
use App\Models\AdminBtcDeposit;
use App\Models\AdminEthDeposit;
use App\Models\AdminBtcTransaction;
use App\Models\AdminEthTransaction;
use App\Models\AdminXrpTransaction; 
use App\Models\Commission; 
use Carbon\Carbon;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function userHistory()
    {
        $pairs = Commission::index();
        return view('usertransaction.history')->with('pair',$pairs);
    }

    public function userHistorySearch(Request $request)
    {

    	if($request->fromdate == ''){
            $request->from = '2019-01-01';
        }else{
            $request->from = new Carbon($request->fromdate);
        }

        if($request->todate == ''){
            $request->to = Carbon::now()->addDays(1);
        }else{
            $request->to = new Carbon(date('Y-m-d',strtotime($request->todate . "+1 days")));
        }

        if($request->pair == 'BTC'){
            $history = UserBtcTransaction::history($request);
        }elseif($request->pair == 'ETH')
        {
            $history = UserEthTransaction::history($request);
        } else{
            $history = UserJadaxTransaction::history($request);
        }
            
        return view('usertransaction.ajax_history')->with('history', $history)->with('pair', $request->pair)->with('type', $request->type)->render();
        

    } 

    public function cryptoDepositList(Request $request)
    {
        $coin = $request->segment(3);

        if($coin == 'BTC'){
                $usdDepositList = UserBtcTransaction::on('mysql2')->where('type','received')->paginate(10);

        }elseif($coin == 'ETH'){
                $usdDepositList = UserEthTransaction::on('mysql2')->where('type','received')->paginate(10);

        }elseif($coin == 'XRP'){
                $usdDepositList = UserXrpTransaction::on('mysql2')->where('type','received')->paginate(10);

        }elseif($coin == 'AZN'){
            $usdDepositList = CurrencyDeposit::depsoitList('AZN');    
            return view('userdeposit.usd_deposit')->with(['deposit'=> $usdDepositList]);
        }       
    	
    	return view('userdeposit.deposit')->with(['depositList'=> $usdDepositList, 'coin' => $coin]);
    } 

    public function usdDepositList()
    {
    	$usdDepositList = CurrencyDeposit::depsoitList('AZN');
    	
    	return view('userdeposit.usd_deposit')->with(['deposit'=> $usdDepositList]);
    } 

    public function depositEdit($id)
    {
        $depositList = CurrencyDeposit::edit(Crypt::decrypt($id));

        return view('userdeposit.deposit_edit')->with(['deposit'=> $depositList]);
    }

    public function depositUpdate(Request $request)
    {
        $depositUpdate = CurrencyDeposit::statusUpdate($request);

        return back()->with('status','Deposit Updated Successfully');
    }


    public function adminBtcDeposit()
    {
        $history = AdminBtcTransaction::deposit();
        $coin = 'BTC';
        return view('history.deposit_history')->with(['history'=> $history,'coin' => $coin]);
    }

    public function adminEthDeposit()
    {
        $history = AdminEthTransaction::deposit();
        $coin = 'ETH';
        return view('history.deposit_history')->with(['history'=> $history,'coin' => $coin]);
    }

    public function adminXrpDeposit()
    {
        $history = AdminXrpTransaction::deposit();
        $coin = 'XRP';
        return view('history.deposit_history')->with(['history'=> $history,'coin' => $coin]);
    }
    
}
