<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $teams = Team::all();
        return View::make('teams.index')->with('teams', $teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/teams/create.blade.php)
        return View::make('teams.create');
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
        $rules = [
            'name'        => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('teams/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $team = new Team;
            $team->name        = Input::get('name');
            $team->description = Input::get('description');
            $team->save();

            // redirect
            Session::flash('message', 'Successfully created team!');
            return Redirect::to('/teams');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        // show the view and pass the nerd to it
        return View::make('teams.show')
            ->with('team', $team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        // show the edit form and pass the nerd
        return View::make('teams.edit')
            ->with('team', $team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = [
            'name'        => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $team->name = Input::get('name');
            $team->description = Input::get('description');
            $team->save();
            // redirect
            Session::flash('message', 'Successfully updated team!');
            return redirect()->route('teams.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        // delete
        $team->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the team!');
        return redirect()->route('teams.index');
    }
}
