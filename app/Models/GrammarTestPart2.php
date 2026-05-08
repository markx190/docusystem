<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class GrammarTestPart2 extends Model
{
    protected $table = "grammar_part2";
	protected $guarded = ['id'];
    
    public static function saveGrammarPart2($request)
    {
        try {
            $grammarPart2 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'gp51' => $request->gp51,
                'gp52' => $request->gp52,
                'gp53' => $request->gp53,
                'gp54' => $request->gp54,
                'gp55' => $request->gp55,
                'gp56' => $request->gp56,
                'gp57' => $request->gp57,
                'gp58' => $request->gp58,
                'gp59' => $request->gp59,
                'gp60' => $request->gp60,
                'gp61' => $request->gp61,
                'gp62' => $request->gp62,
                'gp63' => $request->gp63,
                'gp64' => $request->gp64,
                'gp65' => $request->gp65,
                'gp66' => $request->gp66,
                'gp67' => $request->gp67,
                'gp68' => $request->gp68,
                'gp69' => $request->gp69,
                'gp70' => $request->gp70,
                'gp71' => $request->gp71,
                'gp72' => $request->gp72,
                'gp73' => $request->gp73,
                'gp74' => $request->gp74,
                'gp75' => $request->gp75,
                'gp76' => $request->gp76,
                'gp77' => $request->gp77,
                'gp78' => $request->gp78,
                'gp79' => $request->gp79,
                'gp80' => $request->gp80,
                'gp81' => $request->gp81,
                'gp82' => $request->gp82,
                'gp83' => $request->gp83,
                'gp84' => $request->gp84,
                'gp85' => $request->gp85,
                'gp86' => $request->gp86,
                'gp87' => $request->gp87,
                'gp88' => $request->gp88,
                'gp89' => $request->gp89,
                'gp90' => $request->gp90,
                'gp91' => $request->gp91,
                'gp92' => $request->gp92,
                'gp93' => $request->gp93,
                'gp94' => $request->gp94,
                'gp95' => $request->gp95,
                'gp96' => $request->gp96,
                'gp97' => $request->gp97,
                'gp98' => $request->gp98,
                'gp99' => $request->gp99,
                'gp100' => $request->gp100
            ]);
            return back()->with('success_grammar2', 'Grammar Test Part 2 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

