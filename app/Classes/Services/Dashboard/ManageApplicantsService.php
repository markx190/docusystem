<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Models\Examinees;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use Session;
use DB;
use Exception;
use Auth;
use Mail;

class ManageApplicantsService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('dashboard.manage_applicants', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function applicantsDataTable($request)
    {
        try {
            $qApplicants = DB::table('examinees')->get();
            $results = datatables()->of($qApplicants);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a target="_blank" href="/listening_test_part1/'. $data->e_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-primary btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-e-id-no="'. $data->e_id_no .'"
                                data-e-exam-type="'. $data->exam_type .'"
                                data-e-firstname="'. $data->firstname .'"
                                data-e-middlename="'. $data->middlename .'"
                                data-e-lastname="'. $data->lastname .'"
                                data-e-lastname="'. $data->e_status .'"
                                data-e-position-applied="'. $data->position_applied .'">
                            <i class="fa fa-tasks"></i> Listening Test
                        </button>
                    </a>
                    <a target="_blank" href="/grammar_test_part1/'. $data->e_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-warning btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-e-id-no="'. $data->e_id_no .'"
                                data-e-exam-type="'. $data->exam_type .'"
                                data-e-firstname="'. $data->firstname .'"
                                data-e-middlename="'. $data->middlename .'"
                                data-e-lastname="'. $data->lastname .'"
                                data-e-lastname="'. $data->e_status .'"
                                data-e-position-applied="'. $data->position_applied .'">
                            <i class="fa fa-tasks"></i> Grammar Test
                        </button>
                    </a>
                    <a target="_blank" href="/exam_results/'. $data->e_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-secondary btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-e-id-no="'. $data->e_id_no .'"
                                data-e-exam-type="'. $data->exam_type .'"
                                data-e-firstname="'. $data->firstname .'"
                                data-e-middlename="'. $data->middlename .'"
                                data-e-lastname="'. $data->lastname .'"
                                data-e-lastname="'. $data->e_status .'"
                                data-e-position-applied="'. $data->position_applied .'">
                            <i class="fa fa-tasks"></i> Exam Result
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function addApplicant(Request $request)
    {
        try {
            $addApplicant =  Examinees::saveCreatedApplicant($request);
            return $addApplicant;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveListeningPart1(Request $request)
    {
        try {
            $saveListening1 =  Examinees::saveListeningPart1($request);
            return $saveListening1;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
