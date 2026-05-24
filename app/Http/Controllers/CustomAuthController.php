<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use DB;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function loginCustomer()
    {
        return view('auth.login_customer');
    }
    
    public function registration()
    {
        return view('auth.registration');
    }
    
    public function createAccount()
    {
        return view('auth.register_customer');
    }
    
    public function viewAccount()
    {
        if (!Session::has('login_id')) {
            return redirect()->route('login');
        }
    
        $logData = User::where('id', Session::get('login_id'))->first();
    
        $orders = DB::table('bz_transactions as BT')
            ->join('orders', 'orders.account_id', '=', 'BT.account_id')
            ->join('cart_items as CT', 'CT.order_id', '=', 'orders.order_id')
            ->join('items', 'items.item_id_no', '=', 'CT.item_id_no')
            ->where('BT.account_id', $logData->account_id)
            ->where('BT.status', '!=', 'Cancelled')
            ->select(
                'BT.id',
                'orders.order_id',
                'orders.order_status',          
                'CT.quantity',
                'items.item_name',
                'items.item_avatar'
            )
            ->get();
    
        return view('online.account', [
            'orders' => $orders
        ]);
    }


    public function submitUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|digits:11|unique:users,mobile_number',
            'password' => 'required|min:8|max:12|confirmed',
        ],
        [
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.digits' => 'Mobile number must be 11 digits.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.max' => 'Password must not exceed 12 characters.',
            'password.confirmed' => 'Passwords do not match.',
            ]
        );
    
        $user = new User();
        $user->account_id = mt_rand(100000, 999999);
        $user->account_type = 'Staff';
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
    
        $res = $user->save();
    
        if ($res) {
            return back()->with('reg_success', 'You have registered successfully, please proceed to Login');
        }
    
        return back()->with('fail', 'Something went wrong with your registration');
    }

    public function submitCustomer(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'mobile_number' => 'required|digits:11|unique:users,mobile_number',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:12|confirmed',
            ],
            [
                'firstname.required' => 'First name is required.',
                'lastname.required' => 'Last name is required.',
                'mobile_number.required' => 'Mobile number is required.',
                'mobile_number.digits' => 'Mobile number must be 11 digits.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 6 characters.',
                'password.max' => 'Password must not exceed 12 characters.',
                'password.confirmed' => 'Passwords do not match.',
            ]
        );

        $user = new User();
        $user->account_id = mt_rand(100000, 999999);
        $user->account_type = 'Customer';
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
    
        if ($user->save()) {
            return back()->with('reg_success', 'You have registered successfully, please proceed to Login');
        }
    
        return back()->with('fail', 'Something went wrong with your registration');
    }

    
    public function loginUser(Request $request)
    {
   
    $request->validate([
        'username' => 'required', // can be email or mobile
        'password' => 'required|min:6|max:12',
    ]);

    // Find user by email OR mobile number
    $user = User::where('email', $request->username)
                ->orWhere('mobile_number', $request->username)
                ->first();

    if (!$user) {
        return back()->with('fail', 'This account is not registered.');
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->with('fail', 'Password does not match.');
    }

    // Store login session
    $request->session()->put('login_id', $user->id);

    // Redirect based on account type
    if ($user->account_type === 'Customer') {
        return redirect()->route('store.index'); // Front page for Customers
    }

        // Default: redirect to dashboard for other account types
        // return redirect()->route('dashboard');
        return redirect()->route('dashboard');
    }

    public function logoutAccount()
    {
       if (Session::has('login_id')){
            Session::pull('login_id');
            return redirect('/');
        } 
    }
    
    public function logoutUser()
    {
       if (Session::has('login_id')){
            Session::pull('login_id');
            return redirect('login');
        } 
    }

}
