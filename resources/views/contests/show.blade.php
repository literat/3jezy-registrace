@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Contests</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('contests') }}">View All</a></li>
            <li><a href="{{ URL::to('contests/create') }}">Create</a>
        </ul>

        <h2>{{ $contest->name }}</h2>

        <p>{{ $contest->id }}</p>
        <p>{{ $contest->name }}</p>
        <p>{{ $contest->started_at }}</p>
        <p>{{ $contest->ended_at }}</p>

@stop