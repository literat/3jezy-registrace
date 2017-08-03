<?php

namespace App\Logic\Activation;

use Log;
use Exception;
use App\Models\Activation;
use App\Models\User;
use App\Notifications\SendActivationEmail;
use Carbon\Carbon;

class ActivationRepository
{

    public function createTokenAndSendEmail(User $user)
    {
        Log::info('Creating token and sending email');

        // Limit number of activation attempts to 3 in 24 hours window
        $activations = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

        if ($activations >= config('settings.activation_attemps')) {
            throw new Exception('Activation attemps for sending e-mail exceeded maximum limit.');
        }

        if ($user->activated) { //if user changed activated email to new one

            $user->update([
                'activated' => false
            ]);

        }

        // Create new Activation record for this user/email
        $activation = new Activation;
        $activation->user_id = $user->id;
        $activation->token = str_random(64);
        $activation->save();

        // Send activation email notification
        $user->notify(new SendActivationEmail($activation->token));


    }

    public function deleteExpiredActivations()
    {

        Activation::where('created_at', '<=', Carbon::now()->subHours(72))->delete();

    }
}