@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Categories</h1>

        @include('categories.navbar')

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'contests/'.$contest->id.'/categories')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('shortcut', 'Shortcut') }}
                {{ Form::text('shortcut', Input::old('shortcut'), array('class' => 'form-control')) }}
            </div>

            {{ Form::hidden('contest_id', $contest->id) }}

            {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@stop