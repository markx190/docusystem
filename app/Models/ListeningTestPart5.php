<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ListeningTestPart5 extends Model
{
    protected $table = "listening_part5";
	protected $guarded = ['id'];
    
    public static function saveListeningPart5($request)
    {
        try {
            $listeningPart5 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'lp81' => $request->lp81,
                'lp82' => $request->lp82,
                'lp83' => $request->lp83,
                'lp84' => $request->lp84,
                'lp85' => $request->lp85,
                'lp86' => $request->lp86,
                'lp87' => $request->lp87,
                'lp88' => $request->lp88,
                'lp89' => $request->lp89,
                'lp90' => $request->lp90,
                'lp91' => $request->lp91,
                'lp92' => $request->lp92,
                'lp93' => $request->lp93,
                'lp94' => $request->lp94,
                'lp95' => $request->lp95,
                'lp96' => $request->lp96,
                'lp97' => $request->lp97,
                'lp98' => $request->lp98,
                'lp99' => $request->lp99,
                'lp100' => $request->lp100
            ]);
            return back()->with('success_listen5', 'Listening Test Part 5 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

