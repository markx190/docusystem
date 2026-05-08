<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageBzTransactionsService;
use Illuminate\Http\Request;
use App\User;
use App\Models\Item;
use App\Models\BzTransactions;
use Auth;
use Validator;
use Image;
use Exception;

class ManageBzTransactionsController extends Controller
{
    protected $manageBzTrans;

    public function __construct(ManageBzTransactionsService $manageBzTrans)
    {
        $this->manageBzTrans = $manageBzTrans;
    }

    public function index()
    {
        try {
            $viewBzTrans = $this->manageBzTrans->index();
            return $viewBzTrans;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function bzTransDataTable(Request $request)
    {
        try {
            return $this->manageBzTrans->bzTransDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateBzTransForm(Request $request)
    {
        try {
            return $this->manageBzTrans->updateBzTransForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateBzTrans(Request $request)
    {
        try {
            return $this->manageBzTrans->updateBzTrans($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}