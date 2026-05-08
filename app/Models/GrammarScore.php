<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class GrammarScore extends Model
{
    protected $table = "grammar_score";
	protected $guarded = ['id'];
    
    public static function saveGrammarScore($request)
    {
        try {
            $listeningScore = self::create([
                'test_id_no' => $request->test_id_no,
                'e_id_no' => $request->e_id_no,
                'exam_type' => $request->exam_type,
                'score' => $request->score,                
            ]);
            return back()->with('success_grammar_score', 'Your score was saved');
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

}

