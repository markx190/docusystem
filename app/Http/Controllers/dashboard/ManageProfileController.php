<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Exception;

class ManageProfileController extends Controller
{
    protected $manageProfile;

    public function __construct(ManageProfileService $manageProfile)
    {
        $this->manageProfile = $manageProfile;
    }

    public function index()
    {
        try {
            return $this->manageProfile->indexView();
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editApplicantProfile(Request $request)
    {
        try {
            return $this->manageProfile->editApplicantProfile($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * SHOW EDIT ACCOUNT FORM
     */
    public function editAccount()
    {
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
    
        $user = User::find(Session::get('login_id'));
    
        if (!$user) {
            return redirect('/login');
        }
    
        return view('dashboard.edit_account_component', compact('user', 'dTime'));
    }

    /**
     * UPDATE ACCOUNT
     */
    public function updateAccount(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $user = User::where('id', Session::get('login_id'))->first();
            }
    
        $validated = $request->validate([
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'mobile_number' => 'required|string|max:20',
            'password'      => 'nullable|min:6|confirmed',
            
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
'gov_id' => 'nullable|mimes:jpeg,png,jpg,pdf|max:8048',

        ]);
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))) {
                unlink(public_path('uploads/avatars/' . $user->avatar));
            }
    
            $file = $request->file('avatar');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
    
            $user->avatar = $filename;
        }
        
        if ($request->hasFile('gov_id')) {

    if ($user->gov_id && file_exists(public_path('uploads/gov_ids/' . $user->gov_id))) {
        unlink(public_path('uploads/gov_ids/' . $user->gov_id));
    }

    $govFile = $request->file('gov_id');
    $govName = time().'_gov.'.$govFile->getClientOriginalExtension();
    $govFile->move(public_path('uploads/gov_ids'), $govName);

    $user->gov_id = $govName;
}

    
        // Update fields
        $user->firstname     = $validated['firstname'];
        $user->middlename    = $request->middlename;
        $user->lastname      = $validated['lastname'];
        $user->company       = $request->company;
        $user->mobile_number = $validated['mobile_number'];
        $user->email         = $validated['email'];
        $user->facebook_page = $request->facebook_page;
    
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
    
        $user->save();
    
        return back()->with('edit_profile_success', 'Profile updated successfully.');
    }

}
