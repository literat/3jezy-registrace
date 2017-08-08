<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();

        return View::make('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/roles/create.blade.php)
        return View::make('roles.create');
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
            'name' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('roles/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $role = new Roles;
            $role->name       = Input::get('name');
            $role->save();

            // redirect
            Session::flash('message', 'Successfully created role!');
            return Redirect::to('roles');
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
        // get the nerd
        $role = Roles::find($id);
        // show the view and pass the nerd to it
        return View::make('roles.show')
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the nerd
        $role = Roles::find($id);
        // show the edit form and pass the nerd
        return View::make('roles.edit')
            ->with('role', $role);
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
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('roles/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $role = Roles::find($id);
            $role->name = Input::get('name');
            $role->save();
            // redirect
            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('roles');
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
        $role = Roles::find($id);
        $role->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('roles');
    }
}
