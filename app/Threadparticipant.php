<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class threadparticipant extends Model {

    protected $primaryKey = 'thread_participant';
     //リレーション
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function thread() {
        return $this->belongsTo('App\Thread', 'tweet_id', 'tweet_id');
    }

}
