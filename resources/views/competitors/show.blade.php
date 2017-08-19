@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('competitors.navbar')

        <h2>{{ $competitor->name }}</h2>

        <p>{{ $competitor->id }}</p>
        <p>{{ $competitor->first_name }}</p>
        <p>{{ $competitor->last_name }}</p>
        <p>{{ $competitor->nick_name }}</p>
        <p>{{ $competitor->birthday }}</p>

@stop