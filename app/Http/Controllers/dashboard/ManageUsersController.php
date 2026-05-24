<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\dashboard\ManageUsersService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Routes;
use Auth;
use Validator;
use Image;
use Exception;

class ManageUsersController extends Controller
{
    protected $manageUser;

    public function __construct(ManageUsersService $manageUser)
    {
        $this->manageUser = $manageUser;
    }

    public function index()
    {
        try {
            $viewUsers = $this->manageUser->indexView();
            return $viewUsers;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function usersDataTable(Request $request)
    {
        \Log::info('users');
        try {
            return $this->manageUser->usersDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateUserForm(Request $request)
    {
        try {
            return $this->manageUser->updateUserForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateUser(Request $request)
    {
        return $this->manageUser->updateUser($request);
    }

    public function deleteUserForm(Request $request)
    {
        try {
            return $this->manageUser->deleteUserForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            return $this->manageUser->deleteUser($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}