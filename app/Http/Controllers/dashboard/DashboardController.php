<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Item;
use DB;
use Validator;
use Auth;
use Image;
use Session;
use Exception;

class DashboardController extends Controller
{
	public function login()
	{
		try {
			return view('auth.login');
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}
	
	public function dashboard()
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
		if (Session::has('login_id')){
		  //  dd(Session::has('login_id'));
			$logData = User::where('id', Session::get('login_id'))->first();
			$items = Item::all();
			$countTrans = DB::table('orders')
			                 ->join('cart_items', 'cart_items.order_id', '=', 'orders.order_id')
			                 ->join('items', 'items.item_id_no', '=', 'cart_items.item_id_no')
			                 ->where('items.company_id', $logData->account_id)->count();
			                 
			$countItems = DB::table('items')->where('company_id', $logData->account_id)->count();
			
			$completedTrans = DB::table('orders')->where('order_status','Completed')->count();
$pendingTrans = DB::table('orders')->where('order_status','Unpaid')->count();
			
			$vItems = DB::table('cart_items')
    ->select('item_name', DB::raw('COUNT(*) as count'))
    ->where('company_id', $logData->account_id)
    ->groupBy('item_name')
    ->orderBy('count', 'desc')
    ->get();
			
		}
		
		return view('dashboard.index', [
			'dateTime' => $dTime,
			'user' => $logData,
			'itemsCount' => $countItems,
			'transCount' => $countTrans,
			'vItems' => $vItems,
			'completedTrans' => $completedTrans,
			'pendingTrans' => $pendingTrans
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

}