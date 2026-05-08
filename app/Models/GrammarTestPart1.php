<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class GrammarTestPart1 extends Model
{
    protected $table = "grammar_part1";
	protected $guarded = ['id'];
    
    public static function saveGrammarPart1($request)
    {
        try {
            $grammarPart1 = self::create([
                'exam_type' => $request->exam_type,
                'e_id_no' => $request->e_id_no,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'position_applied' => $request->position_applied,
                'gp1' => $request->gp1,
                'gp2' => $request->gp2,
                'gp3' => $request->gp3,
                'gp4' => $request->gp4,
                'gp5' => $request->gp5,
                'gp6' => $request->gp6,
                'gp7' => $request->gp7,
                'gp8' => $request->gp8,
                'gp9' => $request->gp9,
                'gp10' => $request->gp10,
                'gp11' => $request->gp11,
                'gp12' => $request->gp12,
                'gp13' => $request->gp13,
                'gp14' => $request->gp14,
                'gp15' => $request->gp15,
                'gp16' => $request->gp16,
                'gp17' => $request->gp17,
                'gp18' => $request->gp18,
                'gp19' => $request->gp19,
                'gp20' => $request->gp20,
                'gp21' => $request->gp21,
                'gp22' => $request->gp22,
                'gp23' => $request->gp23,
                'gp24' => $request->gp24,
                'gp25' => $request->gp25,
                'gp26' => $request->gp26,
                'gp27' => $request->gp27,
                'gp28' => $request->gp28,
                'gp29' => $request->gp29,
                'gp30' => $request->gp30,
                'gp31' => $request->gp31,
                'gp32' => $request->gp32,
                'gp33' => $request->gp33,
                'gp34' => $request->gp34,
                'gp35' => $request->gp35,
                'gp36' => $request->gp36,
                'gp37' => $request->gp37,
                'gp38' => $request->gp38,
                'gp39' => $request->gp39,
                'gp40' => $request->gp40,
                'gp41' => $request->gp41,
                'gp42' => $request->gp42,
                'gp43' => $request->gp43,
                'gp44' => $request->gp44,
                'gp45' => $request->gp45,
                'gp46' => $request->gp46,
                'gp47' => $request->gp47,
                'gp48' => $request->gp48,
                'gp49' => $request->gp49,
                'gp50' => $request->gp50
            ]);
            return back()->with('success_grammar1', 'Grammar Test Part 1 was successfuly submitted');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

