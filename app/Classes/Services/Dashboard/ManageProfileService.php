<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use Session;
use DB;
use Exception;
use Auth;
use Mail;

class ManageProfileService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('dashboard.manage_applicants', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
