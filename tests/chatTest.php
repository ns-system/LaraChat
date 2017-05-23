<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use WithoutMiddleware;
use App\Tweet;
use App\User;

class ChatTest extends TestCase {

//    use WithoutMiddleware;
    public function setUp() {
        parent::setUp();
//        $this->tweets = new \App\Repositories\Eloquent\Tweets();
    }

    /**
     * @before
     */
    public function setUpDatabase() {
        $this->artisan('migrate');
        $t = new Tweet;
        $t->comment = 'sample';
        $t->user_id = 1;
        $t->save();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAjax_ポスト() {
//        $request = [
//            "tweet" => "test message.",
//            "userId" => "5",
//            "userName" => "test user",
//            "threadId" => "1",
//        ];
//        $user = User::first();

//        $request = [
//            "tweet" => "test message.",
//            "userId" => "5",
//            "userName" => "test user",
//            "threadId" => "1",
//        ];
//        $user = User::first();
//        $this->actingAs($user)
//            ->post('/tweetsend', $request)
//            ->see('test message.')
//            ->see('test user')
//        ;
//        $t = new Tweet;
//        $t->user_id = 100;
//        $t->comment = 'sample message.';
//        $t->save();
        
//        $this->assertEquals($t->comment, 'sample');

//        $this->actingAs($user)
//            ->post('/tweetupdate', ['userId'=>'1'])
//            ->see('sample')
//        ;
    }
}
