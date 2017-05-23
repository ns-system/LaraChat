<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

    //
    protected $primaryKey = 'tweet_id';
     //リレーション
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function thread() {
        return $this->belongsTo('App\Thread', 'thread_id', 'thread_id');
    }

}
