<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository as Config;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('confirm', ['only' => 'postLogin']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
//    }
    /**
     * ② ユーザーの作成
     * ユーザーを作成し、確認メールを送信する
     *
     * @param Mailer $mailer
     * @param array $data
     * @param $app_key
     * @return User
     */
    protected function create(Mailer $mailer, array $data, $app_key)
    {
        $user = new User;
 
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
 
        $user->makeConfirmationToken($app_key);
        $user->confirmation_sent_at = Carbon::now();
 
        $user->save();
 
        $this->sendConfirmMail($mailer, $user);
 
        return $user;
    }
 
    /**
     * ③ 確認メールの送信
     *
     * @param Mailer $mailer
     * @param User $user
     */
    private function sendConfirmMail(Mailer $mailer, User $user)
    {
        $mailer->send(
            'emails.confirm',
            ['user' => $user, 'token' => $user->confirmation_token],
            function($message) use ($user) {
                $message->to($user->email, $user->name)->subject('ユーザー登録確認');
            }
        );
    }
 
    /**
     * ④ ユーザー登録アクション
     * バリデーションチェックを行い、ユーザーを作成する
     *
     * @param Request $request
     * @param Mailer $mailer
     * @param Config $config
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(Request $request, Mailer $mailer, Config $config)
    {
        $validator = $this->validator($request->all());
 
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
 
        $this->create($mailer, $request->all(), $config->get('app.key'));
 
        \Session::flash('flash_message', 'ユーザー登録確認メールを送りました。');
 
        return redirect('confirm');
    }
 
    /**
     * ⑤ ユーザーを確認済にする
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getConfirm($token) {
        $user = User::where('confirmation_token', '=', $token)->first();
        if (! $user) {
            \Session::flash('flash_message', '無効なトークンです。');
            return redirect('login');
        }
 
        $user->confirm();
        $user->save();
 
        \Session::flash('flash_message', 'ユーザー登録が完了しました。ログインしてください。');
        return redirect('login');
    }
}
