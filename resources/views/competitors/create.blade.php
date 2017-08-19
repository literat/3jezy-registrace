@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('competitors.navbar')

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'competitors')) }}

            <div class="form-group">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('nick_name', 'Nick Name') }}
                {{ Form::text('nick_name', Input::old('nick_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('birthday', 'Birthday') }}
                {{ Form::text('birthday', Input::old('birthday'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@stop