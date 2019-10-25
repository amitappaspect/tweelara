<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['user_id', 'tweet'];

    protected $appends = ['timestamp'];

    public function getTimestampAttribute()
    {
    	return strtotime($this->created_at);
    }

    public function User()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

    public function Likes()
    {
        return $this->hasOne('App\TweetLikes','tweet_id','id');
    }
}
