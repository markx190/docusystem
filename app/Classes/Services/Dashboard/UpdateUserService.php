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
use Validator;
use Session;
use DB;
use Exception;
use Auth;
use Mail;
use Image;

class UpdateUserService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('dashboard.update_user', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateUser(Request $request)
    {
        try {
            \Log::info($request->avatar);
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $updateUser =  User::where('id', $logData->id)->first();
        
            if (!empty($updateUser)) {
                $validation = Validator::make($request->all(), [
                    'avatar' => 'required|image|mimes:jpeg,png,jpg|max:3048'
                ]);
            
                if ($validation->passes()) {
                    if ($request->hasFile('avatar')) {
                        $avatar = $request->file('avatar');
                        \Log::info($avatar);
                        $filename = time() . '.' . $avatar->getClientOriginalExtension();
                        \Log::info($filename);
                        $location = public_path('uploads/avatars/'. $filename); // Use $filename instead of $avatar
                        Image::make($avatar)->save($location);
                        $updateUser->avatar = $filename;  
                    }
            
                    $updateUser->save();     
                    Session::flash('success', 'Profile avatar was changed');
                }
            }
            return $updateUser;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
