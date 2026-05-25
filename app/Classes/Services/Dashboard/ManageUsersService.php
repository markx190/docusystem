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
use Image;
use Exception;
use Auth;
use Mail;

class ManageUsersService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.manage_users_component', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function usersDataTable($request)
    {
        try {
            $users = DB::table('users')->get();
            \Log::info($users);
            $results = datatables()->of($users);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a href="/update_user_form/'. $data->id .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-r-id="'. $data->id .'"
                                data-user-id-no="'. $data->id .'">
                            <i class="fa fa-eye"></i> View
                        </button>
                    </a>
                    ';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateUserForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
                $users = User::where('account_id', '=', $request->uIdNo)->first();

            }    
            return view('management.update_user_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'users' => $users
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function updateUser(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string',
            'status' => 'required|string',
        ], [
            'status.required' => 'User status is required.',
            'company.required' => 'Department is required'
        ]);

        $updateUsers = User::where('id', $request->uIdNo)->first();

        if (!$updateUsers) {
            return back()->with('update_user_failed', 'User not found.');
        }

        $updateUsers->company = $request->company;
        $updateUsers->status = $request->status;

        if ($updateUsers->save()) {
            return back()->with('update_user_success', 'User was updated successfully');
        }

        return back()->with('update_user_failed', 'Something went wrong updating the data');
    }

}
