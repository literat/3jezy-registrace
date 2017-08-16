<?php

namespace App\Http\Controllers;

use App\Models\Contest;

class PagesController extends Controller
{

    /**
     * @return string
     */
    public function getHome()
    {
        $contest = Contest::all()->first();
        return view('pages.home')->with('contest', $contest);
    }

}