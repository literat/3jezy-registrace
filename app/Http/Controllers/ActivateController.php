<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Traits\ActivationTrait;
use App\Models\Activation;

class ActivateController extends Controller
{

    use ActivationTrait;

    /**
     * @param  string $token
     * @return string
     */
    public function activate($token)
    {
        Log::info('ActivateController: try to activate user by token: ' . $token);

        if (auth()->user()->activated) {
            $redirect = redirect()->route('dashboard.home')
                ->with('status', 'success')
                ->with('message', __('auth.email_already_activated'));
        } else {
            $activation = Activation::where('token', $token)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (empty($activation)) {
                $redirect = redirect()->route('dashboard.home')
                    ->with('status', 'wrong')
                    ->with('message', __('auth.no_such_token_in_db'));
            } else {
                auth()->user()->activated = true;
                auth()->user()->save();

                $activation->delete();

                session()->forget('above-navbar-message');

                $redirect = redirect()->route('dashboard.home')
                    ->with('status', 'success')
                    ->with('message', __('auth.successfully_activated'));
            }
        }

        Log::info('ActivateController: user by token activated');

        return $redirect;
    }

    /**
     * @return string
     */
    public function resend()
    {
        try {
            Log::info('ActivateController: try to resent activation email');

            if (auth()->user()->activated == false) {
                $this->initiateEmailActivation(auth()->user());

                $redirect = redirect()->route('dashboard.home')
                    ->with('status', 'success')
                    ->with('message', __('auth.activation_sent'));

                Log::info('ActivateController: activation email sent');
            } else {
                $redirect = redirect()->route('dashboard.home')
                ->with('status', 'success')
                ->with('message', __('auth.already_activated'));

                Log::info('ActivateController: user already activated');
            }

            return $redirect;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }

}