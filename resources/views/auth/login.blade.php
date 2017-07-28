@extends('layouts.sign')

@section('head')

    <link rel="stylesheet" href="/css/signin.css">
    <link rel="stylesheet" href="/css/parsley.css">

@stop

@section('content')

        @include('partials.beside-login')

        <article class="col-sm-5 col-xs-12">

        <div class="contianer-fluid">

        <div class="row">
            <a class="btn btn-info sign-switcher" href="{{ url('register') }}">@lang('auth.register')!</a>
        </div>

        <div class="row">

        {!! Form::open(['url' => url('login'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

        @include('includes.status')

        <h2 class="form-signin-heading">@lang('auth.please_sign_in')</h2>

        <label for="inputEmail" class="sr-only">@lang('auth.email_adderess')</label>
        {!! Form::email('email', null, [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.email_address'),
            'required',
            'id'                            => 'inputEmail',
            'data-parsley-required-message' => __('auth.email_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email'
        ]) !!}

        <label for="inputPassword" class="sr-only">@lang('auth.password')</label>
        {!! Form::password('password', [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.password'),
            'required',
            'id'                            => 'inputPassword',
            'data-parsley-required-message' => __('auth.password_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-minlength'        => '6',
            'data-parsley-maxlength'        => '20'
        ]) !!}

        <div style="height:15px;"></div>
        <div class="row">
            <div class="col-md-12">
                <fieldset class="form-group">
                    {!! Form::checkbox('remember', 1, null, ['id' => 'remember-me']) !!}
                    <label for="remember-me">@lang('auth.remember_me')</label>
                </fieldset>
            </div>
        </div>

        <button class="btn btn-lg btn-primary btn-block login-btn" type="submit">@lang('auth.sign_in')</button>
        <p><a href="{{ url('password/reset') }}">@lang('auth.forgot_password')</a></p>

        <p class="or-social">@lang('auth.or')</p>

        @include('partials.socials', ['sign_type' => 'login'])

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