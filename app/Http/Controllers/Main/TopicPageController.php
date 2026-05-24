<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trends;
use App\Models\TrendLikes;

use Validator;
use Auth;
use DB;
use Session;
use Exception;

class TopicPageController extends Controller
{
    public function index()
    {
        if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
        $trends = Trends::latest()->get();
        return view('main.index', [
            'trends' => $trends,
            'users' => $logData
        ]);
    }

    public function createTopic(Request $request)
    {
    try {
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
        if (!Session::has('login_id')) {
            return back()->with(
                'error',
                'Please login first.'
            );
        }
        $logData = User::find(Session::get('login_id'));
            if (!$logData) {
                return back()->with(
                    'error',
                    'User not found.'
                );
            }

        $validation = Validator::make($request->all(), [
            'trend_name' => 'required|max:220',
            'topic' => 'required',
            'topic_media' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:51200'
        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $trend = new Trends();
        $trend->client_id_no = $logData->account_id;
        $trend->trend_name = $request->trend_name;
        $trend->topic = $request->topic;
        $trend->status = 'active';
       
        if ($request->hasFile('topic_media')) {
            $file = $request->file('topic_media');

            $filename = time().'_'. uniqid().'_'.str_replace(' ','_', $file->getClientOriginalName());
            $path = public_path('uploads/topic_media');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            /* IMAGE */
            if (
                in_array(
                    strtolower($file->extension()),
                    ['jpeg','jpg','png','gif']
                )
            ) {
            \Image::make($file)
                ->resize(
                    1400,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    }
                )
                ->save(
                    $path.'/'.$filename,
                    85
                );
            }
            /* VIDEO */
            else {
                $file->move(
                    $path,
                    $filename
                );
            }
            $trend->topic_media =
                $filename;
        }
        /* SAVE */
        $trend->save();
        return back()->with(
            'success',
            'Topic posted successfully.'
        );
    }

    catch (\Exception $e) {
        \Log::error($e);
        return back()->with(
            'error',
            'Something went wrong.'
            );
        }
    }

    public function editTopic(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'trend_name' => 'required|max:220',
            'topic' => 'required',
            'topic_media' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $trend = Trends::findOrFail($id);
            if ($trend->client_id_no != Auth::user()->client_id_no) {
                return back()->with(
                    'error',
                    'Unauthorized.'
                );
            }
            
            if ($request->hasFile('topic_media')) {
                $file = $request->file('topic_media');
                $mediaName = time().'_'.$file->getClientOriginalName();
                $file->move(
                    public_path('uploads/topics'),
                    $mediaName
                );
                $trend->topic_media = $mediaName;
            }
            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA
            |--------------------------------------------------------------------------
            */
            $trend->trend_name = $request->trend_name;
            $trend->topic = $request->topic;
            $trend->save();
            return back()->with(
                'success',
                'Topic updated successfully.'
            );

        } catch (Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function likeTopic(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Get User
    |--------------------------------------------------------------------------
    */
    $user = User::find(Session::get('login_id'));

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ], 401);
    }

    /*
    |--------------------------------------------------------------------------
    | Validate Request
    |--------------------------------------------------------------------------
    */
    $request->validate([
        'topic_id' => 'required|integer',
        'type' => 'required|in:up,down'
    ]);

    $topicId   = $request->topic_id;
    $type      = $request->type;
    $clientId  = $user->account_id;

    /*
    |--------------------------------------------------------------------------
    | Find Topic
    |--------------------------------------------------------------------------
    */
    $topic = Trends::find($topicId);

    if (!$topic) {
        return response()->json([
            'success' => false,
            'message' => 'Topic not found'
        ], 404);
    }

    /*
    |--------------------------------------------------------------------------
    | Prevent Self Voting
    |--------------------------------------------------------------------------
    */
    if ($topic->client_id_no == $clientId) {
        return response()->json([
            'success' => false,
            'message' => 'You cannot vote on your own topic'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Check Existing Vote
    |--------------------------------------------------------------------------
    */
    $existingVote = TrendLikes::where('topic_id', $topicId)
        ->where('client_id_no', $clientId)
        ->first();

    $message = '';

    /*
    |--------------------------------------------------------------------------
    | Voting Logic (Create / Update / Remove)
    |--------------------------------------------------------------------------
    */
    if ($existingVote) {

        if ($existingVote->type === $type) {

            // remove vote
            $existingVote->delete();
            $message = 'Vote removed';

        } else {

            // switch vote type
            $existingVote->type = $type;
            $existingVote->save();
            $message = 'Vote updated';
        }

    } else {

        // create new vote
        TrendLikes::create([
            'topic_id'      => $topicId,
            'client_id_no'  => $clientId,
            'topic_owner'   => $topic->client_id_no,
            'type'          => $type
        ]);

        $message = 'Vote recorded successfully';
    }

    /*
    |--------------------------------------------------------------------------
    | Recalculate Score (USING RELATIONSHIP)
    |--------------------------------------------------------------------------
    */
    $upvotes = $topic->likes()->where('type', 'up')->count();
    $downvotes = $topic->likes()->where('type', 'down')->count();

    $score = $upvotes - $downvotes;

    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */
    return response()->json([
        'success'   => true,
        'score'     => $score,
        'upvotes'   => $upvotes,
        'downvotes' => $downvotes,
        'message'   => $message
    ]);
}

public function updateTopic(Request $request)
{
    $topic = Trends::find($request->topic_id);

    if(!$topic){

        return response()->json([
            'success' => false
        ]);

    }

    $request->validate([

    'topic_media' => 'nullable|max:51200'

]);

    $data = [

        'trend_name' => $request->trend_name,
        'topic' => $request->topic

    ];

    // NEW MEDIA
    if($request->hasFile('topic_media')){

        $file = $request->file('topic_media');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(
            public_path('uploads/topic_media'),
            $filename
        );

        $data['topic_media'] = $filename;

    }

    $topic->update($data);

    return response()->json([
        'success' => true
    ]);
}
}