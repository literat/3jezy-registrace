@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Roles</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('roles') }}">View All</a></li>
            <li><a href="{{ URL::to('roles/create') }}">Create</a>
        </ul>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'roles')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@stop