<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contest $contest)
    {
        return View::make('categories.index')->with('contest', $contest);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contest $contest)
    {
        // load the create form (app/views/categories/create.blade.php)
        return View::make('categories.create')->with('contest', $contest);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Contest $contest, Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $categories = [
            'name'        => 'required',
            'description' => 'required',
            'shortcut'    => 'required',
        ];
        $validator = Validator::make(Input::all(), $categories);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('categories/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $category = new Category;
            $category->name        = Input::get('name');
            $category->description = Input::get('description');
            $category->shortcut    = Input::get('shortcut');
            $category->contest_id  = Input::get('contest_id');
            $category->save();

            // redirect
            Session::flash('message', 'Successfully created category!');
            return Redirect::to('contests/' . $contest->id . '/categories');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest, Category $category)
    {
        // show the view and pass the nerd to it
        return View::make('categories.show')
            ->with('category', $category)
            ->with('contest', $contest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest, Category $category)
    {
        // show the edit form and pass the nerd
        return View::make('categories.edit')
            ->with('category', $category)
            ->with('contest', $contest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest, Category $category)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $categories = [
            'name'        => 'required',
            'description' => 'required',
            'shortcut'    => 'required',
        ];
        $validator = Validator::make(Input::all(), $categories);
        // process the login
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $category->name = Input::get('name');
            $category->description = Input::get('description');
            $category->shortcut = Input::get('shortcut');
            $category->save();
            // redirect
            Session::flash('message', 'Successfully updated category!');
            return redirect()->route('contests.categories.index', ['contest' => $contest]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest, Category $category)
    {
        // delete
        $category->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the category!');
        return redirect()->route('contests.categories.index', ['contest' => $contest]);
    }

}
