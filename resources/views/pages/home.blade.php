@extends('layouts.main')

@section('content')

    @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Dashboard</h1>

        <ul>
            <li>
            <a href="{{ route('contests.categories.index', ['contest' => $contest]) }}">Kategorie</a>
            </li>
            <li>
                <a href="{{ route('all.constraints') }}">Podmínky a omezení</a>
            </li>
            <li>
                <a href="{{ route('all.checkpoints') }}">Stanoviště</a>
            </li>
            <li>
                <a href="{{ route('competitors.index') }}">Závodníci</a>
            </li>
            <li>
                <a href="{{ route('contests.index') }}">Závody</a>
            </li>
            <li>
                <a href="{{ route('teams.index') }}">Posádky</a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">Uživatelé</a>
            </li>
            <li>
                <a href="{{ route('all.settings') }}">Nastavení</a>
            </li>
            <li>
                <a href="{{ route('roles.index') }}">Role</a>
            </li>
        </ul>

    </div>

@stop