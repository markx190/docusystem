<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Examinees extends Model
{
    protected $table = "examinees";
	protected $guarded = ['id'];
    
    public static function saveExaminee($request)
    {
        try {
            $createExaminee = self::create([
                'e_id_no' => mt_rand(100000, 999999),
                'test_name' => $request->test_name,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'postition_applied' => $request->position_applied,
                'e_status' => 'New Account' 
            ]);
            return back()->with('success', 'Applicants information was successfully inserted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function saveListeningPart1($request)
    {
        try {
            $listeningPart1 = self::create([
                'test_name' => $request->test_name,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'postition_applied' => $request->position_applied,
                'lp1' => $request->lp1,
                'lp2' => $request->lp2,
                'lp3' => $request->lp3,
                'lp4' => $request->lp4,
                'lp5' => $request->lp5,
                'lp6' => $request->lp6,
                'lp7' => $request->lp7,
                'lp8' => $request->lp8,
                'lp9' => $request->lp9,
                'lp10' => $request->lp10,
                'lp11' => $request->lp11,
                'lp12' => $request->lp12,
                'lp13' => $request->lp13,
                'lp14' => $request->lp14,
                'lp15' => $request->lp15,
                'lp16' => $request->lp16,
                'lp17' => $request->lp17,
                'lp18' => $request->lp18,
                'lp19' => $request->lp19,
                'lp20' => $request->lp20
            ]);
            return back()->with('success', 'Listening Test Part 1 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

