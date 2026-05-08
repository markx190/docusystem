<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\GrammarTest;
use App\Classes\Constants\ListeningTest;

use App\Models\Examinees;;
use App\Models\GrammarTestPart1;
use App\Models\GrammarTestPart2;
use App\Models\ListeningTestPart1;
use App\Models\ListeningTestPart2;
use App\Models\ListeningTestPart3;
use App\Models\ListeningTestPart4;
use App\Models\ListeningTestPart5;

use App\Models\GrammarScore;
use App\Models\ListeningScore;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use DB;
use Exception;
use Auth;
use Mail;
use Session;

class ExamService
{
    public function saveListeningPart1(Request $request)
    {
        try {
            $saveListening1 = ListeningTestPart1::saveListeningPart1($request);
            return $saveListening1;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveListeningPart2(Request $request)
    {
        try {
            $saveListening2 = ListeningTestPart2::saveListeningPart2($request);
            return $saveListening2;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveListeningPart3(Request $request)
    {
        try {
            $saveListening3 = ListeningTestPart3::saveListeningPart3($request);
            return $saveListening3;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveListeningPart4(Request $request)
    {
        try {
            $saveListening4 = ListeningTestPart4::saveListeningPart4($request);
            return $saveListening4;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveListeningPart5(Request $request)
    {
        try {
            $saveListening5 = ListeningTestPart5::saveListeningPart5($request);
            return $saveListening5;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveGrammarPart1(Request $request)
    {
        try {
            $saveGrammar1 = GrammarTestPart1::saveGrammarPart1($request);
            return $saveGrammar1;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveGrammarPart2(Request $request)
    {
        try {
            $saveGrammar1 = GrammarTestPart2::saveGrammarPart2($request);
            return $saveGrammar1;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function examResults(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
           
            return view('dashboard.manage_exam_results', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function listeningExamResult1(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $listening1 = ListeningTestPart1::where('e_id_no', $request->eIdNo)->first();
            $listening2 = ListeningTestPart2::where('e_id_no', $request->eIdNo)->first();
            $listening3 = ListeningTestPart3::where('e_id_no', $request->eIdNo)->first();
            $lPart1 = ListeningTest::LISTENING_PART_1;
            return view('dashboard.manage_listening_result1', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'listening1' => $listening1,
                'listening2' => $listening2,
                'listening3' => $listening3,
                'lPart1' => $lPart1,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function listeningExamResult2(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $listening3 = ListeningTestPart3::where('e_id_no', $request->eIdNo)->first();
            $listening4 = ListeningTestPart4::where('e_id_no', $request->eIdNo)->first();
            $listening5 = ListeningTestPart5::where('e_id_no', $request->eIdNo)->first();

            $lPart1 = ListeningTest::LISTENING_PART_1;
            $lPart2 = ListeningTest::LISTENING_PART_2;

            return view('dashboard.manage_listening_result2', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'listening3' => $listening3,
                'listening4' => $listening4,
                'listening5' => $listening5,
                'lPart2' => $lPart2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function GrammarExamResult1(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $grammar1 = GrammarTestPart1::where('e_id_no', $request->eIdNo)->first();
            $gPart1 = GrammarTest::GRAMMAR_PART_1;
            return view('dashboard.manage_grammar_result1', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'grammar1' => $grammar1,
                'gPart1' => $gPart1,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function GrammarExamResult2(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $grammar2 = GrammarTestPart2::where('e_id_no', $request->eIdNo)->first();
            $gPart2 = GrammarTest::GRAMMAR_PART_2;
            return view('dashboard.manage_grammar_result2', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'grammar2' => $grammar2,
                'gPart2' => $gPart2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function saveListeningScore(Request $request)
    {
        try {
            $listeningScore = ListeningScore::saveListeningScore($request);
            return $listeningScore;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function saveGrammarScore(Request $request)
    {
        try {
            $grammarScore = GrammarScore::saveGrammarScore($request);
            return $grammarScore;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function printGrammarExamResult1(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $grammar1 = GrammarTestPart1::where('e_id_no', $request->eIdNo)->first();
            $gScore1 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar1')->pluck('score')->first();
            $gScore2 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar2')->pluck('score')->first();
            $lScore1 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening1')->pluck('score')->first();
            $lScore2 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening2')->pluck('score')->first();

            $gPart1 = GrammarTest::GRAMMAR_PART_1;
            return view('dashboard.print_grammar_result1', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'grammar1' => $grammar1,
                'gPart1' => $gPart1,
                'lScore1' => $lScore1,
                'lScore2' => $lScore2,
                'gScore1' => $gScore1,
                'gScore2' => $gScore2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function printGrammarExamResult2(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $grammar2 = GrammarTestPart2::where('e_id_no', $request->eIdNo)->first();
            $gScore1 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar1')->pluck('score')->first();
            $gScore2 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar2')->pluck('score')->first();
            $lScore1 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening1')->pluck('score')->first();
            $lScore2 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening2')->pluck('score')->first();
            $gPart2 = GrammarTest::GRAMMAR_PART_2;
            
            return view('dashboard.print_grammar_result2', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'grammar2' => $grammar2,
                'gPart2' => $gPart2,
                'lScore1' => $lScore1,
                'lScore2' => $lScore2,
                'gScore1' => $gScore1,
                'gScore2' => $gScore2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function printListeningExamResult1(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $listening1 = ListeningTestPart1::where('e_id_no', $request->eIdNo)->first();
            $listening2 = ListeningTestPart2::where('e_id_no', $request->eIdNo)->first();
            $listening3 = ListeningTestPart3::where('e_id_no', $request->eIdNo)->first();
            $gScore1 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar1')->pluck('score')->first();
            $gScore2 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar2')->pluck('score')->first();
            $lScore1 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening1')->pluck('score')->first();
            $lScore2 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening2')->pluck('score')->first();

            $lPart1 = ListeningTest::LISTENING_PART_1;
            
            return view('dashboard.print_listening_result1', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'listening1' => $listening1,
                'listening2' => $listening2,
                'listening3' => $listening3,
                'lPart1' => $lPart1,
                'lScore1' => $lScore1,
                'lScore2' => $lScore2,
                'gScore1' => $gScore1,
                'gScore2' => $gScore2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function printListeningExamResult2(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $listening3 = ListeningTestPart3::where('e_id_no', $request->eIdNo)->first();
            $listening4 = ListeningTestPart4::where('e_id_no', $request->eIdNo)->first();
            $listening5 = ListeningTestPart5::where('e_id_no', $request->eIdNo)->first();
            $gScore1 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar1')->pluck('score')->first();
            $gScore2 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar2')->pluck('score')->first();
            $lScore1 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening1')->pluck('score')->first();
            $lScore2 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening2')->pluck('score')->first();

            $lPart2 = ListeningTest::LISTENING_PART_2;
            
            return view('dashboard.print_listening_result2', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'listening3' => $listening3,
                'listening4' => $listening4,
                'listening5' => $listening5,
                'lPart2' => $lPart2,
                'lScore1' => $lScore1,
                'lScore2' => $lScore2,
                'gScore1' => $gScore1,
                'gScore2' => $gScore2,
                'user' => $logData
            ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function printExamResultPercentage(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dDate = date('F j, Y');
            $dTime = date('H:i:s');

            $eApplicant = Examinees::where('e_id_no', $request->eIdNo)->first();
            $gScore1 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar1')->pluck('score')->first();
            $gScore2 = GrammarScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Grammar2')->pluck('score')->first();
            $lScore1 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening1')->pluck('score')->first();
            $lScore2 = ListeningScore::where('e_id_no', $request->eIdNo)->where('exam_type', 'Listening2')->pluck('score')->first();
            
            $totalScore = $gScore1 + $gScore2 + $lScore1 + $lScore2;
            $tPercentage = $totalScore / 200 * 100;

            return view('dashboard.print_exam_percentage', [
                'dateTime' => $dTime,
                'eApplicant' => $eApplicant,
                'lScore1' => $lScore1,
                'lScore2' => $lScore2,
                'gScore1' => $gScore1,
                'gScore2' => $gScore2,
                'totalScore' => $totalScore,
                'tPercentage' => $tPercentage,
                'dDate' => $dDate,
                'dTime' => $dTime
                ]);
            } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

}
