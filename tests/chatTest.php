<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use WithoutMiddleware;
use App\Tweet;
use App\User;

class ChatTest extends TestCase
{

//    use WithoutMiddleware;
//    public function setUp() {
//        parent::setUp();
////        $this->tweets = new \App\Repositories\Eloquent\Tweets();
//    }
    /**
     * @before
     */
    public function setUpDatabase() {
//    public static function setUpBeforeClass() {
        $this->artisan('migrate');
        $t1            = new Tweet;
        $t1->comment   = 'sample';
        $t1->thread_id = 1;
        $t1->user_id   = 1;
        $t1->save();
        $t2            = new Tweet;
        $t2->comment   = 'other sample 1';
        $t2->thread_id = 1;
        $t2->user_id   = 999;
        $t2->save();
    }

    public function test_setTweetCount() {
        try {
            \Chat::setTweetCount();
        } catch (Exception $ex) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue(false);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test新しく発言する() {
        $user = User::first();
//        echo $user->name;
        $this->actingAs($user)
                ->visit('/chat')
                ->type('Test data.', 'tweet')
                ->press('add')
//                ->pause(5000)
                ->see('Test data.')
        ;
    }

    public function test_addTweet_エラー() {
        try {
            \Chat::addTweet();
        } catch (Exception $ex) {
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue(false);
    }

    public function test他人の発言を取得する() {
        $user         = User::first();
        $this->actingAs($user)
                ->visit('/chat')
//                ->press('Update')
        ;
//        $count        = Tweet::All()->count();
        sleep(1);
        $t            = new Tweet;
        $t->comment   = 'other comment1';
        $t->thread_id = 1;
        $t->user_id   = 999;
        $t->save();
        $t            = new Tweet;
        $t->comment   = 'other comment2';
        $t->thread_id = 1;
        $t->user_id   = 999;
        $t->save();
        sleep(1);
//        $this->see(0);
//        sleep(5);
        $this->press('Update')
                ->see('other comment1')
                ->see('other comment2')
        ;
    }

    public function test_recieveTweet() {

        try {
            \Chat::recieveTweet()->getTweet();
        } catch (Exception $ex) {
//            echo $ex->getMessage();
            $this->assertTrue(true);
            return;
        }
        $this->assertTrue(false);
    }

    public function test_eraseTweet() {
        try {
            \Chat::eraseTweet();
        } catch (Exception $ex) {
//            echo $ex->getMessage();
//            $this->assertTrue(true);
            return;
        }
        $this->assertTrue(false);
    }

    public function test発言を削除() {
//        $before = Tweet::All();
//        foreach ($before as $b) {
//            echo $b->tweet_id.' / ';
//        }
//        echo "\n";
//        $this->seeInDatabase('tweets', ['tweet_id' => 14]);
        $user   = User::first();
        $before = Tweet::where('user_id', $user->id)->count();
        $this->actingAs($user)
                ->visit('/chat')
                ->press('erase')
                ->see('発言を削除しました')
        ;
        $after = Tweet::where('user_id', $user->id)->count();
//        echo "$before <> $after";
        $flag   = ($before > $after) ? true : false;
        $this->assertTrue($flag);
//        echo " / ";
//        $before = Tweet::All();
//        foreach ($before as $b) {
//            echo $b->tweet_id.' / ';
//        }
//        $this->notSeeInDatabase('tweets', ['tweet_id' => 14]);
    }

}
