@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Users</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View All</a></li>
            <li><a href="{{ URL::to('users/create') }}">Create</a>
        </ul>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'users')) }}

            <div class="form-group">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', Input::old('password'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password_confirmation', 'Password Confirmation') }}
                {{ Form::password('password_confirmation', Input::old('password_confirmation'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('activated', 'Activated') }}
                {{ Form::checkbox('activated', Input::old('activated'), null, array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@stop