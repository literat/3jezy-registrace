<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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

    public function login(Request $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');
        $remember   = $request->get('remember');

        if ($this->auth->attempt([
            'email'     => $email,
            'password'  => $password
        ], $remember == 1 ? true : false)) {

            if ( $this->auth->user()->hasRole('user')) {

                return redirect()->route('user.home');

            }

            if ( $this->auth->user()->hasRole('administrator')) {

                return redirect()->route('admin.home');

            }

        }
        else {

            return redirect()->back()
                ->with('message','Incorrect email or password')
                ->with('status', 'danger')
                ->withInput();
        }

    }

}