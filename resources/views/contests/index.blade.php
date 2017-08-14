@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Contests</h1>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('contests') }}">View All</a></li>
            <li><a href="{{ URL::to('contests/create') }}">Create</a>
        </ul>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Started at</td>
                    <td>Ended at</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                </tr>
            </thead>
            <tbody>
            @foreach($contests as $contest)
                <tr>
                    <td>{{ $contest->id }}</td>
                    <td>{{ $contest->name }}</td>
                    <td>{{ $contest->started_at }}</td>
                    <td>{{ $contest->ended_at }}</td>
                    <td>{{ $contest->created_at }}</td>
                    <td>{{ $contest->updated_at }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'contests/' . $contest->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-small btn-warning')) }}
                        {{ Form::close() }}

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('contests/' . $contest->id) }}">Show</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('contests/' . $contest->id . '/edit') }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@stop