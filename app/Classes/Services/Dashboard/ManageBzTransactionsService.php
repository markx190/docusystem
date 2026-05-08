<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
// use Datatables;
use Session;
use Validator;
use DB;
use App\Models\Item;
use App\Models\ItemImages;
use App\Models\BzTransactions;
use Image;
use Exception;
use Auth;
use Mail;

class ManageBzTransactionsService
{
    public function index()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
                $totalOrders = DB::table('orders')->sum('total_amount');
            }
            return view('management.manage_bztrans_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'totalOrdersAmount' => $totalOrders
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function bzTransDataTable($request)
    {
        try {
            $bzTrans = DB::table('orders')->get();
                       \Log::info($bzTrans);
            $results = datatables()->of($bzTrans);
                return $results
                    
                    ->addColumn('action', function ($data) {
                        $action = '<a target="_blank" href="/update_bztrans_form/'. $data->order_id .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-e-id="'. $data->id .'"
                                data-order-id="'. $data->order_id .'">
                            <i class="fa fa-edit"></i> Update
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }


}
