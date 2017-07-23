<?php

namespace App\Http\Controllers;

class UserController extends Controller
{

    public function getHome()
    {

        return view('panels.user.home');

    }

    public function getProtected()
    {

        return view('panels.user.protected');

    }

}