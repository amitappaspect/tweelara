<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetLikes extends Model
{
    protected $table = 'tweet_likes';

    protected $fillable = ['tweet_id','total_like','user_ids'];

}
