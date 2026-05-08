<?php

namespace App\Http\Controllers\Payments;
use App\Http\Controllers\Controller;
use App\Classes\Services\Payments\PaymentsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;
use Session;

class PaymentsController extends Controller
{
    protected $payments;

    public function __construct(PaymentsService $payments)
    {
        $this->payments = $payments;
    }

    public function index()
    {
        try {
            $viewPayments = $this->payments->indexView();
            return $viewPayments;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function paymentsDataTable(Request $request)
    {
        try {
            return $this->payments->paymentsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function submitBuyerDetails(Request $request)
    {
        try {
            return $this->payments->submitBuyerDetails($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}