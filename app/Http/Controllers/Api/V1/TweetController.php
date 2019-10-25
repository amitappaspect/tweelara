<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tweet;
use Auth;
use App\TweetLikes;

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
    	$tweets = Tweet::with('User','Likes')->orderBy('created_at','DESC')->get();

    	return response()->json([
            'status' => 1,
            'tweets'=>$tweets
        ]);
    }

    public function like(Request $request)
    {
        $tweetLike = TweetLikes::where('tweet_id',$request->tweet_id)->first();
        
        if ($tweetLike) {
            
            // check if user id exist;
            $userIds = explode(",", $tweetLike->user_ids);

            if (in_array($request->user_id, $userIds)) {
                $newArray = array_diff($userIds,[$request->user_id]);

                $tweetLike->user_ids = implode(",", $newArray);
                $tweetLike->total_like = $tweetLike->total_like -1;
                $tweetLike->save();
                
                return response()->json(['status'=>2,'message'=>'success']);

            }else{
                array_push($userIds, $request->user_id);
                $tweetLike->user_ids = implode(",",$userIds);
                $tweetLike->total_like = $tweetLike->total_like +1;
                $tweetLike->save();

                return response()->json(['status'=>1,'message'=>'success']);
            }

        }else{
            $tweetLike = new TweetLikes();

            $tweetLike->tweet_id = $request->tweet_id;
            $tweetLike->user_ids = $request->user_id;
            $tweetLike->total_like = 1;
            $tweetLike->save();

            return response()->json(['status'=>1,'message'=>'success']);
        }
    }
}
