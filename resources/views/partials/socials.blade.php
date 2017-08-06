<div class="row margin-bottom-10">
    {{-- <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('social.redirect', ['provider' => 'skautis']) }}" class="btn btn-lg waves-effect waves-light btn-block github">
            <i class="fa fa-user"></i>
            @lang('auth.skautis', ['sign_type' => __('auth.' . $sign_type)])
        </a>
    </div> --}}
    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg waves-effect waves-light  btn-block facebook">
            <i class="fa fa-facebook-official"></i>
            @lang('auth.facebook', ['sign_type' => __('auth.' . $sign_type)])
        </a>
    </div>
    {{-- <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg  waves-effect waves-light btn-block twitter">
            <i class="fa fa-twitter"></i>
            @lang('auth.twitter', ['sign_type' => __('auth.' . $sign_type)])
        </a>
    </div> --}}
    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg waves-effect waves-light btn-block google">
            <i class="fa fa-google-plus-official"></i>
            @lang('auth.google', ['sign_type' => __('auth.' . $sign_type)])
        </a>
    </div>
</div>