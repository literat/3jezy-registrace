<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Traits\ActivationTrait;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class UsersController extends Controller
{

    use ActivationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return View::make('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/users/create.blade.php)
        return View::make('users.create')
            ->with('roles', $this->findAllRolesForSelect());
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
        $users = [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required',
            'password'              => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:password',
        ];
        $validator = Validator::make(Input::all(), $users);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user =  User::create([
                'first_name' => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'email'      => Input::get('email'),
                'password'   => bcrypt(Input::get('password')),
                'token'      => str_random(64),
                'activated'  => !config('settings.activation')
            ]);

            $role = Role::whereName('user')->first();
            $user->assignRole($role);
            $user->save();

            $this->initiateEmailActivation($user);

            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('users');
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
        $user = User::find($id);
        // show the view and pass the nerd to it
        return View::make('users.show')
            ->with('user', $user);
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
        $user = User::find($id);

        // show the edit form and pass the nerd
        return View::make('users.edit')
            ->with('user', $user)
            ->with('roles', $this->findAllRolesForSelect());
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
        $users = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
        ];
        $validator = Validator::make(Input::all(), $users);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->activated = Input::get('activated', '0');

            $role = Role::find(Input::get('roles'));
            $user->assignRole($role);

            $user->save();
            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('users');
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
        $user = User::find($id);
        $user->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the user!');
        return Redirect::to('users');
    }

    /**
     * @return Collection
     */
    protected function findAllRolesForSelect(): Collection
    {
        return Role::all()->pluck('name', 'id');
    }

}
