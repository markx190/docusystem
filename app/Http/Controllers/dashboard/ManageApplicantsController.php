<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageApplicantsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class ManageApplicantsController extends Controller
{
    protected $manageApplicant;

    public function __construct(ManageApplicantsService $manageApplicant)
    {
        $this->manageApplicant = $manageApplicant;
    }

    public function index()
    {
        try {
            $viewApplicants = $this->manageApplicant->indexView();
            return $viewApplicants;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function applicantsDataTable(Request $request)
    {
        try {
            return $this->manageApplicant->applicantsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addApplicant(Request $request)
    {
        try {
            return $this->manageApplicant->addApplicant($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateApplicant(Request $request)
    {
        try {
            return $this->manageApplicant->updateApplicant($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}