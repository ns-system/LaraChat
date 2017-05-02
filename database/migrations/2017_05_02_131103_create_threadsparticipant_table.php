<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsparticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threadsparticipant', function (Blueprint $table) {
            $table->increments('threads_participant_id');
            $table->timestamps();
            $table->integer('post_id');
            $table->integer('threads_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('threadsparticipant');
    }
}
