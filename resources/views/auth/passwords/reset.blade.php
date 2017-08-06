@extends('layouts.sign')

@section('head')
    <link rel="stylesheet" href="/css/parsley.css">
    {!! Html::style('/css/reset-form.css') !!}
@stop

@section('content')

        @include('partials.beside-login')

        <article class="col-sm-5 col-xs-12">

        <div class="contianer-fluid">

        <div class="row">

        {!! Form::open(['url' => url('/password/reset/'), 'class' => 'form-signin', 'method' => 'post', 'data-parsley-validate' ] ) !!}

        @include('includes.errors')

        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <h2 class="form-signin-heading">@lang('auth.set_new_password')</h2>

        <label for="inputEmail" class="sr-only">@lang('auth.email_address')</label>
        {!! Form::email('email', null, [
            'class'                         => 'form-control',
            'placeholder'                   => __('auth.email_address'),
            'required',
            'id'                            => 'inputEmail',
            'data-parsley-required-message' => __('auth.email_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-type'             => 'email',
            'autofocus'
        ]) !!}

        <label for="inputPassword" class="sr-only">@lang('auth.password')</label>
        {!! Form::password('password', [
            'class' => 'form-control',
            'placeholder' => __('auth.password'),
            'required',
            'id' => 'inputPassword',
            'data-parsley-required-message' => __('auth.password_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-minlength'        => '6',
            'data-parsley-maxlength'        => '20'
        ]) !!}


        <label for="inputPasswordConfirmation" class="sr-only">@lang('auth.password_confirmation')</label>
        {!! Form::password('password_confirmation', [
            'class' => 'form-control',
            'placeholder' => __('auth.password_confirmation'),
            'required',
            'id' => 'inputPasswordConfirmation',
            'data-parsley-required-message' => __('auth.password_confirmation_is_required'),
            'data-parsley-trigger'          => 'change focusout',
            'data-parsley-equalto'          => '#inputPassword',
            'data-parsley-equalto-message'  => __('auth.not_same_password'),
        ]) !!}


        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.change')</button>

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