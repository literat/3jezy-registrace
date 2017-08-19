@extends('layouts.main')

@section('content')

        @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">

        @include('competitors.navbar')

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Nick Name</td>
                    <td>Birthday</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                </tr>
            </thead>
            <tbody>
            @foreach($competitors as $competitor)
                <tr>
                    <td>{{ $competitor->id }}</td>
                    <td>{{ $competitor->first_name }}</td>
                    <td>{{ $competitor->last_name }}</td>
                    <td>{{ $competitor->nick_name }}</td>
                    <td>{{ $competitor->birthday }}</td>
                    <td>{{ $competitor->created_at }}</td>
                    <td>{{ $competitor->updated_at }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                        {{ Form::open(array('url' => 'competitors/' . $competitor->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-small btn-warning')) }}
                        {{ Form::close() }}

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('competitors/' . $competitor->id) }}">Show</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('competitors/' . $competitor->id . '/edit') }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@stop