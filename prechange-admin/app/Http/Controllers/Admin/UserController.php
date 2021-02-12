<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\User;
use App\Models\UserBtcAddress;
use App\Models\UserEthAddress;
use App\Models\UserProfile;
use App\Models\UserWallet;
use App\Models\UserXrpAddress;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;
use Mail;
use App\Mail\EmailVerification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $details = User::index();
        return view('user.users')->with('details', $details);
    }

    public function edit(Request $request)
    {
        $user_id = Crypt::decrypt($request->id);
        // $wallet = User::userWalletDetails($user_id);

        if ($user_id) {
            $user = User::find($user_id);
          
            return view('user.user_edit', ['userdetails' => $user, 'phone' => '', 'address' => '']);
        }
    }

    public function update(Request $request)
    {

        $user = User::userUpdate($request);

        if ($user) {
            \Session::flash('updated_status', 'Profile Details Updated Successfully.');
        } else {
            \Session::flash('updated_status', 'Profile Details Updated Failed.');
        }

        return redirect()->back();
    }

    public function userSearchList(Request $request)
    {
        $userSearchList = User::searchList($request);

        return view('user.users')->with('details', $userSearchList);
    }

    public function userStatus(Request $request)
    {
        $userSearchList = User::userStatusChange($request);

        return 1;
    }

    public function sendEmail(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $is_user = User::on('mysql2')->where('id', $id)->first();
        if(is_object($is_user) > 0)
        {
            $update = User::on('mysql2')->where('id', $id)->update(['verifyToken' => Str::random(40)]);
            $thisUser = User::on('mysql2')->findOrFail($is_user->id);
            $this->sendVerificationEmail($thisUser);
            \Session::flash('status', 'Verification Email Sent.');
            return redirect('admin/users');
        }
    }

    public function sendVerificationEmail($thisUser)
    {
       try
       {
          Mail::to($thisUser['email'])->send(new EmailVerification($thisUser));
       }
       catch (Exception $e)
       {
          dd($e);
       }
    }


    public function excel_view(Request $request)
    {
        $user_id = Crypt::decrypt($request->id);
        $user_details = User::getIndividualUser($user_id);

        if ($user_id) {
            return view('user.userexcelview')->with('user', $user_details);
        }
    }

    public function exportExcel()
    {
        /* $items = User::excelExport();
        Excel::create('user', function($excel) use($items) {
        $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
        });
        })->export('xls');*/

        Excel::create('Jadax_users_details', function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                // first row styling and writing content
                $sheet->mergeCells('A1:K1');
                $sheet->mergeCells('F2:H2');
                $sheet->mergeCells('I2:K2');
                $sheet->mergeCells('L2:N2');

                $sheet->setCellValue('H2', '=SUM(F2:G2)');
                $sheet->setCellValue('K2', '=SUM(I2:J2)');
                $sheet->setCellValue('N2', '=SUM(L2:M2)');

                // $sheet->setMergeColumn(array(
                //     'columns' => array('A','B','C','D'),
                //     'rows' => array(
                //         array(2,3),
                //         array(5,11),
                //         )
                //     ));

                $sheet->cell('F2', function ($cell) {
                    // manipulate the cell
                    $cell->setValue('BTC Wallets');
                    $cell->setFontWeight('bold');

                });
                $sheet->cell('I2', function ($cell) {
                    // manipulate the cell
                    $cell->setValue('ETH Wallets');
                    $cell->setFontWeight('bold');

                });
                $sheet->cell('L2', function ($cell) {
                    // manipulate the cell
                    $cell->setValue('Jadax Wallets');
                    $cell->setFontWeight('bold');

                });

                $sheet->row(1, function ($row) {
                    // $row->setFontFamily('Comic Sans MS');
                    // $row->setFontSize(30);
                });
                $sheet->row(1, array('Jadax User Details'));
                // second row styling and writing content
                // $sheet->row(2, function ($row) {
                //    // call cell manipulation methods
                //     // $row->setFontFamily('Comic Sans MS');
                //     // $row->setFontSize(15);
                //     // $row->setFontWeight('bold');
                // });
                // $sheet->row(2, array('Something else here'));
                // getting data to display - in my case only one record
                $users = User::excelExport();
                // setting column names for data - you can of course set it manually
                $sheet->appendRow(array_keys($users[0])); // column names
                // getting last row number (the one we already filled and setting it to bold
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });
                // putting users data as next rows
                foreach ($users as $user) {

                    $sheet->appendRow($user);
                }
            });
        })->export('xls');
        //return Excel::download(new User, 'user'.date('dMY').'.xlsx');
    }

    public function exportIndividualUserXls(Request $request)
    {
        $user_id = $request->segment(4);
        $type = $request->segment(5);
        $users = User::getIndividualUser($user_id);

        if ($type == 'pdf') {
            $pdf = PDF::loadView('user.test', array('user' => $users));
            return $pdf->download('user.pdf');
        } else {
            Excel::create('user', function ($excel) use ($users) {
                $excel->sheet('sheet1', function ($sheet) use ($users) {
                    $sheet->loadView('user.convertexcel')->with('user', $users);
                });
            })->download($type);
        }
    }

    public function deactiveUser()
    {
        $details = User::list_deactive_user();
        return view('user.users')->with('details', $details);
    }

    public function todayUser()
    {
        $details = User::list_today_user();
        return view('user.users')->with('details', $details);
    }

    public function kyc_RequestUser()
    {
        $details = User::kyc_request_user();
        return view('user.users')->with('details', $details);
    }

    public function userWallet(Request $request)
    {
        $id = $request->segment(3);
        $user_id = Crypt::decrypt($id);
        $coin_list = Commission::on('mysql2')->get();



        $address = array();

        foreach ($coin_list as $list) {

            if ($list->source == 'BTC') {

                $btc = UserBtcAddress::where('user_id', $user_id)->first();
                if (is_object($btc)) {
                    $address[$list->source] = $btc->address;
                } else {
                    $address[$list->source] = '-';
                }

            }
            if ($list->source == 'ETH') {

                $btc = UserEthAddress::where('user_id', $user_id)->first();
                if (is_object($btc)) {
                    $address[$list->source] = $btc->address;
                } else {
                    $address[$list->source] = '-';
                }
            }
            if ($list->source == 'XRP') {

                $btc = UserXrpAddress::where('user_id', $user_id)->first();
                if (is_object($btc)) {
                    $address[$list->source] = $btc->address;
                } else {
                    $address[$list->source] = '-';
                }
            }

            if ($list->source == 'AZN') {
                $address[$list->source] = '-';
            }

             if ($list->source == 'USD') {
                $address[$list->source] = '-';
            }

             if ($list->source == 'LTC') {
                $address[$list->source] = '-';
            }

        }

        $wallet_details = UserWallet::on('mysql2')->where('user_id', $user_id)->get();

        return view('user.wallet')->with('uid', $user_id)->with('coins', $coin_list)->with('address', $address);
    }

    public function updateWallet(Request $request)
    {
        $details = UserWallet::walletUpdate($request);

        return redirect()->back()->with('updated_status', 'Balance updated Successfully.');
    }

}