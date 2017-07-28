@extends('layouts.main')

@section('head')
    {!! Html::style('/css/reset.css') !!}
@stop

@section('content')

        {!! Form::open(['url' => url('/password/email'), 'class' => 'form-signin' ] ) !!}

        @include('includes.status')

        <h2 class="form-signin-heading">@lang('auth.password_reset')</h2>
        <label for="inputEmail" class="sr-only">@lang('auth.email_address')</label>
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('auth.email_address'), 'required', 'autofocus', 'id' => 'inputEmail' ]) !!}

        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.send_reset_link')</button>

        {!! Form::close() !!}

@stop