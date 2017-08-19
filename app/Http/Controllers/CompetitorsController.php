<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CompetitorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitors = Competitor::all();

        return View::make('competitors.index')->with('competitors', $competitors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/competitors/create.blade.php)
        return View::make('competitors.create');
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'required|date',
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('competitors/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $competitor = new Competitor;
            $competitor->first_name = Input::get('first_name');
            $competitor->last_name  = Input::get('last_name');
            $competitor->nick_name  = Input::get('nick_name');
            $competitor->birthday   = Input::get('birthday');
            $competitor->save();

            // redirect
            return redirect()->to('competitors')
                ->with('status', 'success')
                ->with('message', 'Successfully created competitor!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the competitor
        $competitor = Competitor::find($id)->first();

        // show the view and pass the nerd to it
        return View::make('competitors.show')
            ->with('competitor', $competitor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the competitor
        $competitor = Competitor::find($id);
        // show the edit form and pass the nerd
        return View::make('competitors.edit')
            ->with('competitor', $competitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => 'required|date',
        ];
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('competitors/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $competitor = Competitor::find($id);
            $competitor->first_name = Input::get('first_name');
            $competitor->last_name = Input::get('last_name');
            $competitor->nick_name = Input::get('nick_name');
            $competitor->birthday = Input::get('birthday');
            $competitor->save();
            // redirect
            return redirect()->to('competitors')
                ->with('status', 'success')
                ->with('message', 'Successfully updated competitor!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $competitor = Competitor::find($id);
        $competitor->delete();
        // redirect
        return redirect()->to('competitors')
            ->with('status', 'success')
            ->with('message', 'Successfully deleted the competitor!');
    }

}
