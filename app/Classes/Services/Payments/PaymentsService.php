<?php

namespace App\Classes\Services\Payments;
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

class PaymentsService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('payments.manage_payments', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveOrder(Request $request)
    {
        try {
            $orders = $request->all();
        
            // Store the FormData in the session
            $request->session()->put('orders', $orders);
            \Log::info($request);

        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function submitBuyerDetails(Request $request)
    {
        try {
            $reqBody = array('title' => "buzytown.com", 
                            'amount' => 59990,
                            'currency' => "PHP", 
                            'description' => "Test",
                            'private_notes' => "Test",
                            'limit' => 0,
                            'fee_pass_on' => false,
                            'redirect_url' => "http://localhost:9000/checkout",
                            'nonce' => 1318874398806
                        );
            $clientSecret = "phm17j2abxwzqscfs4bzc6j6";

            $reqBodyJson = json_encode($reqBody, JSON_UNESCAPED_SLASHES);
            $signature = hash_hmac('sha256', $reqBodyJson, $clientSecret);
            // dd($signature);
            
            // $first_name = $request->input('first_name');
            // $last_name = $request->input('last_name');
            // $email_address = $request->input('email_address');
            // $phone_number = $request->input('phone_number');

            $formData = $request->all();
        
            // Store the FormData in the session
            $request->session()->put('form_data', $formData);
            return response()->json($signature);
            // return redirect()->route('view_checkout')->with('success', 'Data has been stored in the session.');

        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
