@extends('layouts.sign')

@section('head')
    {!! Html::style('/css/register.css') !!}
    {!! Html::style('/css/parsley.css') !!}
@stop

@section('content')

        @include('partials.beside-login')

        <article class="col-sm-5 col-xs-12">

        <div class="contianer-fluid">

        <div class="row">
            <a class="btn btn-info sign-switcher" href="{{ url('login') }}">@lang('auth.login')!</a>
        </div>

        <div class="row">

        {!! Form::open(['url' => url('register'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

        @include('includes.errors')

        <h2 class="form-signin-heading">@lang('auth.please_register')</h2>

        <label for="inputEmail" class="sr-only">@lang('auth.email_address')</label>
        {!! Form::email('email', null, [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.email_address'),
            'required',
            'id'                            => 'inputEmail',
            'data-parsley-required-message' => __('auth.email_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email'
        ]) !!}

        <label for="inputFirstName" class="sr-only">@lang('auth.first_name')</label>
        {!! Form::text('first_name', null, [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.first_name'),
            'required',
            'id'                            => 'inputFirstName',
            'data-parsley-required-message' => __('auth.first_name_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-pattern'          => '/^[a-zA-Z\u00C0-\u017F]*$/',
            'data-parsley-minlength'        => '2',
            'data-parsley-maxlength'        => '32'
        ]) !!}

        <label for="inputLastName" class="sr-only">@lang('auth.last_name')</label>
        {!! Form::text('last_name', null, [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.last_name'),
            'required',
            'id'                            => 'inputLastName',
            'data-parsley-required-message' => __('auth.last_name_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-pattern'          => '/^[a-zA-Z\u00C0-\u017F]*$/',
            'data-parsley-minlength'        => '2',
            'data-parsley-maxlength'        => '32'
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


        <label for="inputPasswordConfirm" class="sr-only has-warning">Confirm Password</label>
        {!! Form::password('password_confirmation', [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.password_confirmation'),
            'required',
            'id'                            => 'inputPasswordConfirm',
            'data-parsley-required-message' => __('auth.password_confirmation_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-equalto'          => '#inputPassword',
            'data-parsley-equalto-message'  => __('auth.not_same_password'),
        ]) !!}

        <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

        <button class="btn btn-lg btn-primary btn-block register-btn" type="submit">@lang('auth.register')</button>

        <p class="or-social">@lang('auth.or')</p>

        @include('partials.socials', ['sign_type' => 'register'])

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

    {!! HTML::script('/plugins/parsley.min.js') !!}

    <script src='https://www.google.com/recaptcha/api.js'></script>

@stop