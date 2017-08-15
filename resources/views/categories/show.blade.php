@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Categories</h1>

        @include('categories.navbar')

        <h2>{{ $category->name }}</h2>

        <p>{{ $category->id }}</p>
        <p>{{ $category->name }}</p>
        <p>{{ $category->description }}</p>
        <p>{{ $category->shortcut }}</p>

@stop