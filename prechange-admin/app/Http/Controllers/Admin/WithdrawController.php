<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserBtcTransaction;
use App\Models\UserEthTransaction;

use App\Models\CurrencyWithdraw;
use App\Models\CurrencyDeposit;
use App\Models\UserXrpTransaction;

use App\Models\AdminBtcTransaction;
use App\Models\AdminEthTransaction;
use App\Models\AdminXrpTransaction;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function withdrawHistory()
    {
    	$pairs = Commission::index();
        return view('usertransaction.withdraw')->with('pair',$pairs);
    }


    public function cryptoWithdrawList(Request $request)
    {
        $coin = $request->segment(3);

        if($coin == 'BTC'){
            $usdDepositList = UserBtcTransaction::on('mysql2')->where('type','send')->orderBy('id','desc')->paginate(10);
        }elseif($coin == 'ETH'){
            $usdDepositList = UserEthTransaction::on('mysql2')->where('type','send')->orderBy('id','desc')->paginate(10);

        }elseif($coin == 'XRP'){
            $usdDepositList = UserXrpTransaction::on('mysql2')->where('type','send')->orderBy('id','desc')->paginate(10);
        }        
    	
    	return view('userwithdraw.withdraw')->with(['transaction'=> $usdDepositList, 'currency' => $coin]);
    } 

    public function withdrawHistorySearch($id)
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
            $history = UserBtcTransaction::withdraw_history($request);
        }elseif($request->pair == 'ETH')
        {
            $history = UserEthTransaction::withdraw_history($request);
        } else{
            $history = AdminXrpTransaction::withdraw_history($request);
        }
            
        return view('usertransaction.ajax_withdraw_history')->with('history', $history)->with('pair', $request->pair)->render();
    }

        //Crypto Withdraw
    public function btcWithdrawEdit($id)
    {
         $withdraw = UserBtcTransaction::on('mysql2')
                        ->where('type','send')
                        ->where('id',$id)
                        ->first();



        return view('userwithdraw.cryptowithdraw_edit',[
            'withdraw' => $withdraw, 'coin' => 'BTC'
        ]);
    }

    public function updateBtcWithdraw(Request $request)
    {
        $withdraw = UserBtcTransaction::withdrawUpdate($request);

        return back()->with('status',$withdraw);

    }


    public function ethWithdrawEdit($id)
    {
            $withdraw = UserEthTransaction::on('mysql2')
                        ->where('type','send')
                        ->where('id',$id)
                        ->first();
    
        return view('userwithdraw.cryptowithdraw_edit',[
            'withdraw' => $withdraw, 'coin' => 'ETH'
        ]);
       
    }

    public function updateEthWithdraw(Request $request)
    {
        $withdraw = UserEthTransaction::withdrawUpdate($request);

        return back()->with('status',$withdraw);

    }


        public function xrpWithdrawEdit($id)
    {

         $withdraw = UserXrpTransaction::on('mysql2')
                        ->where('type','send')
                        ->where('id',$id)
                        ->first();
    
        return view('userwithdraw.cryptowithdraw_edit',[
            'withdraw' => $withdraw, 'coin' => 'XRP'
        ]);
    }



    public function updateXrpWithdraw(Request $request)
    {
        $withdraw = UserXrpTransaction::withdrawUpdate($request);

        return back()->with('status',$withdraw);

    }

    public function usdWithdrawList()
    {
    	$crypto_trasnaction = CurrencyWithdraw::histroy('USD');
        
        return view('userwithdraw.usd_withdraw', ['currency' => 'USD', 'transaction' => $crypto_trasnaction]); 
    } 


    public function withdrawEdit($id)
    {
        $crypto_trasnaction = CurrencyWithdraw::edit(Crypt::decrypt($id));
        
        return view('userwithdraw.withdraw_edit', ['withdraw' => $crypto_trasnaction]); 
    }

    public function withdrawUpdate(Request $request)
    {

        $crypto_trasnaction = CurrencyWithdraw::withdrawUpdate($request);

        return back()->with('status','Withdraw Updated Successfully');
    }



    public function adminBtcWithdraw()
    {
        $history = AdminBtcTransaction::withdraw();
        $coin = 'BTC';
        return view('history.withdraw_history')->with(['history'=> $history,'coin'=>$coin]);
    }

    public function adminEthWithdraw()
    {
        $history = AdminEthTransaction::withdraw();
        $coin = 'ETH';
        return view('history.withdraw_history')->with(['history'=> $history,'coin'=>$coin]);
    }

    public function adminXrpWithdraw()
    {
        
        $history = AdminXrpTransaction::withdraw();
        $coin = 'XRP';
        return view('history.withdraw_history')->with(['history'=> $history,'coin'=>$coin]);
    }
}
