<?php

namespace App\Traits;

use Log;
use App\Logic\Activation\ActivationRepository;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

trait ActivationTrait
{

    public function initiateEmailActivation(User $user)
    {
        Log::info('Initializing email activation');
        if ( !config('settings.activation')  || !$this->validateEmail($user)) {

            return true;

        }

        $activationRepostory = new ActivationRepository();

        $activationRepostory->createTokenAndSendEmail($user);

    }

    protected function validateEmail(User $user)
    {

        // Check does email posses valid format, cause if it's social account without
        // email, it'll have value of missingxxxxxxxxxx
        $validator = Validator::make(['email' => $user->email], ['email' => 'required|email']);

        if ($validator->fails()) {
            return false; // Stopping job execution, if it return false it will break entire application
        }

        return true;

    }

}