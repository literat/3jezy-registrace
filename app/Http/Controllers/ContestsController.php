<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ContestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contest = Contest::all();

        return View::make('contests.index')->with('contests', $contest);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/contests/create.blade.php)
        return View::make('contests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $contests = [
            'name'       => 'required',
            'started_at' => 'required',
            'ended_at'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $contests);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('contests/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $contest = new Contest;
            $contest->name       = Input::get('name');
            $contest->started_at = Input::get('started_at');
            $contest->ended_at   = Input::get('ended_at');
            $contest->save();

            // redirect
            Session::flash('message', 'Successfully created contest!');
            return Redirect::to('contests');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the contest
        $contest = Contest::find($id)->first();

        // show the view and pass the nerd to it
        return View::make('contests.show')
            ->with('contest', $contest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the contest
        $contest = Contest::find($id);
        // show the edit form and pass the nerd
        return View::make('contests.edit')
            ->with('contest', $contest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $contests = [
            'name'       => 'required',
            'started_at' => 'required',
            'ended_at'   => 'required',
        ];
        $validator = Validator::make(Input::all(), $contests);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('contests/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $contest = Contest::find($id);
            $contest->name = Input::get('name');
            $contest->started_at = Input::get('started_at');
            $contest->ended_at = Input::get('ended_at');
            $contest->save();
            // redirect
            Session::flash('message', 'Successfully updated contest!');
            return Redirect::to('contests');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $contest = Contest::find($id);
        $contest->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the contest!');
        return Redirect::to('contests');
    }

}
