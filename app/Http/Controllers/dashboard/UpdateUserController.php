<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\UpdateUserService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class UpdateUserController extends Controller
{
    protected $manageUser;

    public function __construct(UpdateUserService $manageUser)
    {
        $this->manageUser = $manageUser;
    }

    public function index(Request $request)
    {
        try {
            $viewUser = $this->manageUser->indexView($request);
            return $viewUser;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = $this->manageUser->updateUser($request);
            return $user;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
}