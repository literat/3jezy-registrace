<?php

return [

    /*
     * Is email activation required
     */
    'activation' => env('ACTIVATION', false),

    /*
     * Limit number of activation attempts to 3 in 24 hours window
     */
    'activation_attemps' => env('ACTIVATION_ATTEMPS', 3),

];