<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ExamService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Examinees;
use App\Models\User;
use Validator;
use Auth;
use Image;
use Session;
use Exception;

class ExamController extends Controller
{

	protected $exam;

    public function __construct(ExamService $exam)
    {
        $this->exam = $exam;
    }

	public function registerExaminee(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
			$logData = User::where('id', Session::get('login_id'))->first();
		}
		return view('dashboard.manage_register_examinee', [
			'dateTime' => $dTime,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function saveExaminee(Request $request)
	{
		try {
			$saveExaminee = Examinees::saveExaminee($request);
            return $saveExaminee;
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}
	
	public function listeningTestPart1(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_exam_l1', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function listeningTestPart2(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_exam_l2', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function listeningTestPart3(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_exam_l3', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function listeningTestPart4(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_exam_l4', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function listeningTestPart5(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_exam_l5', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function submitListeningPart1(Request $request)
    {
        try {
            return $this->exam->saveListeningPart1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitListeningPart2(Request $request)
    {
        try {
            return $this->exam->saveListeningPart2($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitListeningPart3(Request $request)
    {
        try {
            return $this->exam->saveListeningPart3($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitListeningPart4(Request $request)
    {
        try {
            return $this->exam->saveListeningPart4($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitListeningPart5(Request $request)
    {
        try {
            return $this->exam->saveListeningPart5($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function GrammarTestPart1(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_grammar_g1', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function GrammarTestPart2(Request $request)
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
		$eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
		return view('dashboard.manage_grammar_g2', [
			'dateTime' => $dTime,
			'eApplicant' => $eApplicant,
            'user' => $logData
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function submitGrammarPart1(Request $request)
    {
        try {
            return $this->exam->saveGrammarPart1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitGrammarPart2(Request $request)
    {
        try {
            return $this->exam->saveGrammarPart2($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function examResults(Request $request)
    {
        try {
            return $this->exam->examResults($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function listeningExamResult1(Request $request)
    {
        try {
            return $this->exam->listeningExamResult1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function listeningExamResult2(Request $request)
    {
        try {
            return $this->exam->listeningExamResult2($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitListeningScore(Request $request)
    {
        try {
            return $this->exam->saveListeningScore($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function submitGrammarScore(Request $request)
    {
        try {
            return $this->exam->saveGrammarScore($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function grammarExamResult1(Request $request)
    {
        try {
            return $this->exam->grammarExamResult1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function grammarExamResult2(Request $request)
    {
        try {
            return $this->exam->grammarExamResult2($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function printGrammarExamResult1(Request $request)
    {
        try {
            return $this->exam->printGrammarExamResult1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function printGrammarExamResult2(Request $request)
    {
        try {
            return $this->exam->printGrammarExamResult2($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function printListeningExamResult1(Request $request)
    {
        try {
            return $this->exam->printListeningExamResult1($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

	public function printExamResultPercentage(Request $request)
    {
        try {
            return $this->exam->printExamResultPercentage($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}