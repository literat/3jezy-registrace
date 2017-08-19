@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('competitors.navbar')

        <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($competitor, array('action' => array('CompetitorsController@update', $competitor->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('nick_name', 'Nick Name') }}
            {{ Form::text('nick_name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('birthday', 'Birthday') }}
            {{ Form::text('birthday', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop