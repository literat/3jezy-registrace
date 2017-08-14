@extends('layouts.main')

@section('content')

    @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Dashboard</h1>

        <ul>
            <li>
            <a href="{{ route('all.categories') }}">Kategorie</a>
            </li>
            <li>
                <a href="{{ route('all.constraints') }}">Podmínky a omezení</a>
            </li>
            <li>
                <a href="{{ route('all.checkpoints') }}">Stanoviště</a>
            </li>
            <li>
                <a href="{{ route('all.competitors') }}">Závodníci</a>
            </li>
            <li>
                <a href="{{ URL::to('contests') }}">Závody</a>
            </li>
            <li>
                <a href="{{ route('all.teams') }}">Posádky</a>
            </li>
            <li>
                <a href="{{ URL::to('users') }}">Uživatelé</a>
            </li>
            <li>
                <a href="{{ route('all.settings') }}">Nastavení</a>
            </li>
            <li>
                <a href="{{ URL::to('roles') }}">Role</a>
            </li>
        </ul>

    </div>

@stop