<?php

namespace App\Http\Controllers\Auth;

use App\Traits\CaptchaTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Traits\ActivationTrait;
use App\Models\User;
use App\Models\Roles;

/**
 |--------------------------------------------------------------------------
 | Register Controller
 |--------------------------------------------------------------------------
 |
 | This controller handles the registration of new users as well as their
 | validation and creation. By default this controller uses a trait to
 | provide this functionality without requiring any additional code.
 |
 */
class RegisterController extends Controller
{

    use RegistersUsers, ActivationTrait, CaptchaTrait;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        $validator = Validator::make($data,
            [
                'first_name'            => 'required',
                'last_name'             => 'required',
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:6|max:20',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => 'required',
                'captcha'               => 'required|min:1'
            ],
            [
                'first_name.required'   => 'First Name is required',
                'last_name.required'    => 'Last Name is required',
                'email.required'        => 'Email is required',
                'email.email'           => 'Email is invalid',
                'password.required'     => 'Password is required',
                'password.min'          => 'Password needs to have at least 6 characters',
                'password.max'          => 'Password maximum length is 20 characters',
                'g-recaptcha-response.required' => 'Captcha is required',
                'captcha.min'           => 'Wrong captcha, please try again.'
            ]
        );

        return $validator;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(64),
            'activated' => !config('settings.activation')
        ]);

        $role = Roles::whereName('user')->first();
        $user->assignRole($role);

        $this->initiateEmailActivation($user);

        return $user;
    }

}