<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    /**
     * @return string
     */
    public function getHome()
    {
        return view('pages.home');
    }

}