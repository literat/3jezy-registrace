@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('teams.navbar')

        <h2>{{ $team->name }}</h2>

        <p>{{ $team->id }}</p>
        <p>{{ $team->name }}</p>
        <p>{{ $team->description }}</p>

@stop