<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/*
 |--------------------------------------------------------------------------
 | Login Controller
 |--------------------------------------------------------------------------
 |
 | This controller handles authenticating users for the application and
 | redirecting them to your home screen. The controller uses a trait
 | to conveniently provide its functionality to your applications.
 |
 */
class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Auth guard
     *
     * @var
     */
    protected $auth;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * LoginController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }

    /**
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');
        $remember   = $request->get('remember');

        if ($this->auth->attempt([
                'email'     => $email,
                'password'  => $password
            ], $remember == 1 ? true : false)
        ) {
            if ( $this->auth->user()->hasRole('user')) {
                $redirect = redirect()->route('all.dashboard');
            }

            if ( $this->auth->user()->hasRole('administrator')) {
                //$redirect = redirect()->route('admin.home');
                $redirect = redirect()->route('all.dashboard');
            }
        } else {
            $redirect = redirect()->back()
                ->with('message', __('auth.incorrect_login'))
                ->with('status', 'danger')
                ->withInput();
        }

        return $redirect;

    }

}