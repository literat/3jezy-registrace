@extends('layouts.sign')

@section('head')

    <link rel="stylesheet" href="/css/signin.css">
    <link rel="stylesheet" href="/css/parsley.css">

@stop

@section('head')
    {!! Html::style('/css/reset.css') !!}
@stop

@section('content')

        @include('partials.beside-login')

        <article class="col-sm-5 col-xs-12">

        <div class="contianer-fluid">

        <div class="row">

        {!! Form::open(['url' => url('/password/email'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

        @include('includes.status')
        @include('includes.errors')

        <h2 class="form-signin-heading">@lang('auth.password_reset')</h2>
        <label for="inputEmail" class="sr-only">@lang('auth.email_address')</label>
        {!! Form::email('email', null, [
            'class' => 'form-control',
            'placeholder' => __('auth.email_address'),
            'required',
            'autofocus',
            'id' => 'inputEmail',
            'data-parsley-required-message' => __('auth.email_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email'
        ]) !!}

        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.send_reset_link')</button>

        {!! Form::close() !!}

        </div>

        </div>

        </article>

@stop

@section('footer')

    <script type="text/javascript">
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<span class="error-text"></span>',
            classHandler: function (el) {
                return el.$element.closest('input');
            },
            successClass: 'valid',
            errorClass: 'invalid'
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.5.0/parsley.min.js"></script>

@stop