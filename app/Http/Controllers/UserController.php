<?php

namespace App\Http\Controllers;

class UserController extends Controller
{

    /**
     * @return string
     */
    public function getHome()
    {
        return view('panels.user.home');
    }

    /**
     * @return string
     */
    public function getProtected()
    {
        return view('panels.user.protected');
    }

}