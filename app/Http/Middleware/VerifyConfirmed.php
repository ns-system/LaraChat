<?php // app/Http/Middleware/VerifyConfirmed.php
namespace App\Http\Middleware;
 
use Closure;
use App\User;
 
class VerifyConfirmed {
    public function handle($request, Closure $next)
    {
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user) {
            if(! $user->isConfirmed()) {
                \Session::flash('flash_message', 'ユーザーがアクティベートされていないようです。メールを確認した上で、ユーザーをアクティベートしてください。');
                return redirect()->back()->withInput($request->only('email'));
            }
        }
 
        return $next($request);
    }
}