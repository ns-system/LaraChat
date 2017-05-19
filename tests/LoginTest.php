<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
class sample extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->users = new \App\Repositories\Eloquent\Users();
    }
    /**
     * @before
     */
    public function setUpDatabase()
    {
        $this->artisan('migrate');
    }
    public function testユーザー登録_成功(){
//        $sample = User::All();
//        var_dump(User::All());
        $this->visit('/auth/register')
            ->type('test user','name')
            ->type('test@test.com','email')
            ->type('test123','password')
            ->type('test123','password_confirmation')
            ->press('登録')
            ->seePageIs('/auth/confirm')
            ->see('メール')
        ;
        $token = User::first();
        $this->visit('/auth/register/confirm/'.$token->confirmation_token);
        $this->seePageIs('/')
            ->see('ユーザー登録が完了しました')
        ;
    }
    public function testログイン成功()
    {
        $this->visit('/')
            ->see('ログイン')
            ->type('test@test.com','email')
            ->type('test123','password')
            ->press('ログイン')
            ->seePageIs('home')
        ;
    }
    public function testログイン失敗()
    {
        $this->visit('/')
            ->see('ログイン')
            ->type('n.teshima@jf-nssinren.or.jp','email')
            ->press('ログイン')
            ->seePageIs('/')
            ->see('passwordは必須です')
            ->seePageIs('/')
            ->type('','email')
            ->type('teshima','password')
            ->press('ログイン')
            ->seePageIs('/')
            ->see('emailは必須です')
        ;
    }
    public function testパスワード紛失_失敗(){
        $this->visit('/')
            ->click('パスワードを忘れましたか？')
            ->seePageIs('/auth/password/email')
            ->press('メールを送る')
            ->see('emailは必須です')
            ->seePageIs('/auth/password/email')
            ->type('test@test.comi','email')
            ->press('メールを送る')
            ->see('メールアドレスが登録されていないようです')
            ->seePageIs('/auth/password/email')
            ->type('test@test','email')
            ->press('メールを送る')
            ->see('emailを正しいメールアドレスにしてください')
        ;
//        var_dump(User::All());
    }
}