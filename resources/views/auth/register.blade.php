@extends('layouts.main')

@section('head')
    {!! Html::style('/css/register.css') !!}
    {!! Html::style('/css/parsley.css') !!}
@stop

@section('content')

        {!! Form::open(['url' => url('register'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

        @include('includes.errors')

        <h2 class="form-signin-heading">Please register</h2>

        <label for="inputEmail" class="sr-only">Email address</label>
        {!! Form::email('email', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'Email address',
            'required',
            'id'                            => 'inputEmail',
            'data-parsley-required-message' => 'Email is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email'
        ]) !!}

        <label for="inputFirstName" class="sr-only">First name</label>
        {!! Form::text('first_name', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'First name',
            'required',
            'id'                            => 'inputFirstName',
            'data-parsley-required-message' => 'First Name is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-pattern'          => '/^[a-zA-Z\u00C0-\u017F]*$/',
            'data-parsley-minlength'        => '2',
            'data-parsley-maxlength'        => '32'
        ]) !!}

        <label for="inputLastName" class="sr-only">Last name</label>
        {!! Form::text('last_name', null, [
            'class'                         => 'form-control',
            'placeholder'                   => 'Last name',
            'required',
            'id'                            => 'inputLastName',
            'data-parsley-required-message' => 'Last Name is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-pattern'          => '/^[a-zA-Z\u00C0-\u017F]*$/',
            'data-parsley-minlength'        => '2',
            'data-parsley-maxlength'        => '32'
        ]) !!}


        <label for="inputPassword" class="sr-only">Password</label>
        {!! Form::password('password', [
            'class'                         => 'form-control',
            'placeholder'                   => 'Password',
            'required',
            'id'                            => 'inputPassword',
            'data-parsley-required-message' => 'Password is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-minlength'        => '6',
            'data-parsley-maxlength'        => '20'
        ]) !!}


        <label for="inputPasswordConfirm" class="sr-only has-warning">Confirm Password</label>
        {!! Form::password('password_confirmation', [
            'class'                         => 'form-control',
            'placeholder'                   => 'Password confirmation',
            'required',
            'id'                            => 'inputPasswordConfirm',
            'data-parsley-required-message' => 'Password confirmation is required',
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-equalto'          => '#inputPassword',
            'data-parsley-equalto-message'  => 'Not same as Password',
        ]) !!}

        <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

        <button class="btn btn-lg btn-primary btn-block register-btn" type="submit">Register</button>

        <p class="or-social">Or Use Social Login</p>

        @include('partials.socials')

        {!! Form::close() !!}


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