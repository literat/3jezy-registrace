@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Contests</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('contests') }}">View All</a></li>
            <li><a href="{{ URL::to('contests/create') }}">Create</a>
        </ul>

        <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($contest, array('action' => array('ContestsController@update', $contest->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('started_at', 'Started at') }}
            {{ Form::text('started_at', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('ended_at', 'Ended at') }}
            {{ Form::text('ended_at', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop