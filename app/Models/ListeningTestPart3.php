<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ListeningTestPart3 extends Model
{
    protected $table = "listening_part3";
	protected $guarded = ['id'];
    
    public static function saveListeningPart3($request)
    {
        try {
            $listeningPart3 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'lp41' => $request->lp41,
                'lp42' => $request->lp42,
                'lp43' => $request->lp43,
                'lp44' => $request->lp44,
                'lp45' => $request->lp45,
                'lp46' => $request->lp46,
                'lp47' => $request->lp47,
                'lp48' => $request->lp48,
                'lp49' => $request->lp49,
                'lp50' => $request->lp50,
                'lp51' => $request->lp51,
                'lp52' => $request->lp52,
                'lp53' => $request->lp53,
                'lp54' => $request->lp54,
                'lp55' => $request->lp55,
                'lp56' => $request->lp56,
                'lp57' => $request->lp57,
                'lp58' => $request->lp58,
                'lp59' => $request->lp59,
                'lp60' => $request->lp60
            ]);
            return back()->with('success_listen3', 'Listening Test Part 3 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

