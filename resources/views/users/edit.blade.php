@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Users</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('user') }}">View All</a></li>
            <li><a href="{{ URL::to('users/create') }}">Create</a>
        </ul>

        <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('activated', 'Activated') }}
            {{ Form::checkbox('activated', '1', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                {{ Form::label('roles', 'Roles') }}
                {{ Form::select('roles', $roles, null, array('class' => 'form-control')) }}
            </div>

        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop