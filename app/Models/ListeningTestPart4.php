<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ListeningTestPart4 extends Model
{
    protected $table = "listening_part4";
	protected $guarded = ['id'];
    
    public static function saveListeningPart4($request)
    {
        try {
            $listeningPart4 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'lp61' => $request->lp61,
                'lp62' => $request->lp62,
                'lp63' => $request->lp63,
                'lp64' => $request->lp64,
                'lp65' => $request->lp65,
                'lp66' => $request->lp66,
                'lp67' => $request->lp67,
                'lp68' => $request->lp68,
                'lp69' => $request->lp69,
                'lp70' => $request->lp70,
                'lp71' => $request->lp71,
                'lp72' => $request->lp72,
                'lp73' => $request->lp73,
                'lp74' => $request->lp74,
                'lp75' => $request->lp75,
                'lp76' => $request->lp76,
                'lp77' => $request->lp77,
                'lp78' => $request->lp78,
                'lp79' => $request->lp79,
                'lp80' => $request->lp80
            ]);
            return back()->with('success_listen4', 'Listening Test Part 4 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

