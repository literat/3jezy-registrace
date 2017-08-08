<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use App\Models\Roles;

class SocialController extends Controller
{

    /**
     * @param  string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getSocialRedirect($provider)
    {
        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {
            return view('pages.status')
                ->with('error', __('app.no_such_provider'));
        }

        return Socialite::driver( $provider )->redirect();
    }

    /**
     * @param  string $provider
     * @return \Laravel\Socialite\Two\User
     */
    public function getSocialHandle($provider)
    {
        if (Input::get('denied') != '') {
            return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', __('app.did_not_share_social_data'));
        }

        $user = Socialite::driver( $provider )->user();

        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {
            $socialUser = $userCheck;
        } else {
            $sameSocialId = Social::where('social_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email              = $email;
                $name = explode(' ', $user->name);

                if (count($name) >= 1) {
                    $newSocialUser->first_name = $name[0];
                }

                if (count($name) >= 2) {
                    $newSocialUser->last_name = $name[1];
                }

                $newSocialUser->password = bcrypt(str_random(16));
                $newSocialUser->token = str_random(64);
                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                $newSocialUser->social()->save($socialData);

                // Add role
                $role = Roles::whereName('user')->first();
                $newSocialUser->assignRole($role);

                $socialUser = $newSocialUser;
            } else {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }

        auth()->login($socialUser, true);

        if ( auth()->user()->hasRole('user')) {
            return redirect()->route('user.home');
        }

        if ( auth()->user()->hasRole('administrator')) {
            return redirect()->route('admin.home');
        }

        return abort(500, __('app.user_no_role_assigned'));

    }
}