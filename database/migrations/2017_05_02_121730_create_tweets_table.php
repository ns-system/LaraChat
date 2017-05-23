<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     * ap
     * @return void
     */
    public function up()
    {
         Schema::create('tweets', function(Blueprint $table){
            $table->increments('tweet_id');
            $table->integer('user_id');
            $table->integer('thread_id');
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tweets');
    }
}
