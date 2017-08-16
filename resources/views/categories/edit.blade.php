@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('categories.navbar')

        <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($category, [
        'action' => [
            'CategoriesController@update',
            $contest->id,
            $category->id,
        ],
        'method' => 'PUT'
    ]) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('shortcut', 'Shortcut') }}
            {{ Form::text('shortcut', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop