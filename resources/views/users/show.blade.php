@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Users</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View All</a></li>
            <li><a href="{{ URL::to('users/create') }}">Create</a>
        </ul>

        <h2>{{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})</h2>

        <p>{{ $user->id }}</p>
        <p>{{ $user->first_name }}</p>
        <p>{{ $user->last_name }}</p>
        <p>{{ $user->email }}</p>
        <p>{{ $user->activated }}</p>
        <p>{{ $user->created_at }}</p>
        <p>{{ $user->updated_at }}</p>

@stop