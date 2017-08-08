@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Roles</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('roles') }}">View All</a></li>
            <li><a href="{{ URL::to('roles/create') }}">Create</a>
        </ul>

        <h2>{{ $role->name }}</h2>

@stop