<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Auth;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;

        view()->share('web', $this->web);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function recovery()
    {
        return view('auth.recovery');
    }

    public function password(Request $request)
    {
        if (! $request->has('token') || ! $this->user->whereRememberToken($request->get('token'))->exists()) {
            abort(401);
        }

        return view('auth.password')->with('token', $request->get('token'));
    }

    public function login_post(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (! app('App\Models\Webs\Web')->users()->where('email', $request->get('email'))->exists()) {
            flash('Ha ocurrido un error al enviar el formulario. Revisa los campos.', 'error');
            return back()->withErrors([
                'email' => ['La cuenta introducida no existe en el sistema']
            ]);
        }

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $this->clearLoginAttempts($request);
            flash('¡Hola ' . Auth::user()->name . '!');
            if ($request->has('to')) {
                return redirect()->to($request->get('to'));
            } elseif (Auth::user()->isAdmin() && Auth::user()->hasPermission('admin')) {
                return redirect()->route('admin::panel::index');
            } else {
                return redirect()->route('web::index');
            }
        }

        $this->incrementLoginAttempts($request);

        flash('Ha ocurrido un error al enviar el formulario. Revisa los campos.', 'error');
    
        $logins_to_block = $this->limiter()->retriesLeft($this->throttleKey($request), 5);
        if ($logins_to_block > 2) {
            return back()->withErrors([
                'email' => ['El correo electrónico o la contraseña no son válidos.']
            ]);
        } elseif ($logins_to_block === 0) {
            return back()->withErrors([
                'email' => ['Su cuenta ha sido temporalmente bloqueada. Prueba de nuevo en 1 minuto.']
            ]); 
        } else {
            return back()->withErrors([
                'email' => ['El correo electrónico o la contraseña no son válidos. Le quedan ' . $logins_to_block . ' intentos, luego se bloqueará al usuario durante 1 minuto.']
            ]);    
        }
    }

    public function recovery_post(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);

        $user = $this->user->whereEmail($request->get('email'))->first();

        Mail::send('emails.auth.recovery', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Recuperar cuenta');
        });

        return back()->with('recovery', 1);
    }

    public function password_post(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|exists:users,remember_token',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = $this->user->whereRememberToken($request->get('token'))->first();

        $user->update([
            'password' => $request->get('password'),
            'remember_token' => str_random(10)
        ]);

        return redirect()->route('auth::login')->with('password', 1);
    }

    public function logout()
    {
        if (app('App\Models\Webs\Web')->subdomain === 'admin') {
            app('App\Models\Webs\Web')->unsetConfig('web');
        }

        Auth::logout();
        return redirect()->route('auth::login');
    }

    public function username()
    {
        return 'email';
    }
}
