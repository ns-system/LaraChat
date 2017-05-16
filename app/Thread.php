<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thread extends Model {

    protected $primaryKey = 'thread_id';

     //リレーション
    public function tweets() {
        return $this->hasMany('App\Tweet');
    }

    public function tweets_participant() {
        return $this->hasMany('App\Tweet');
    }

}
