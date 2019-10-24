<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tweet;
use Auth;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        $request['user_id'] = $request->user_id;

        Tweet::create($request->all());

        return response()->json([
            'status' => 1,
            'message' => 'Tweet Posted Successfully!'
        ]);
    }

    public function all(Request $request)
    {
    	$tweets = Tweet::with('User')->orderBy('created_at','DESC')->get();

    	return response()->json([
            'status' => 1,
            'tweets'=>$tweets
        ]);
    }
}
