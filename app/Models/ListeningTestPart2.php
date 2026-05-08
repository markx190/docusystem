<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ListeningTestPart2 extends Model
{
    protected $table = "listening_part2";
	protected $guarded = ['id'];
    
    public static function saveListeningPart2($request)
    {
        try {
            $listeningPart2 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'lp21' => $request->lp21,
                'lp22' => $request->lp22,
                'lp23' => $request->lp23,
                'lp24' => $request->lp24,
                'lp25' => $request->lp25,
                'lp26' => $request->lp26,
                'lp27' => $request->lp27,
                'lp28' => $request->lp28,
                'lp29' => $request->lp29,
                'lp30' => $request->lp30,
                'lp31' => $request->lp31,
                'lp32' => $request->lp32,
                'lp33' => $request->lp33,
                'lp34' => $request->lp34,
                'lp35' => $request->lp35,
                'lp36' => $request->lp36,
                'lp37' => $request->lp37,
                'lp38' => $request->lp38,
                'lp39' => $request->lp39,
                'lp40' => $request->lp40
            ]);
            return back()->with('success_listen2', 'Listening Test Part 2 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

