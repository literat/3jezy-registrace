<div class="row margin-bottom-10">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-lg waves-effect waves-light  btn-block facebook">Facebook</a>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-lg  waves-effect waves-light btn-block twitter">Twitter</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg waves-effect waves-light btn-block google">Google+</a>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <a href="{{ route('social.redirect', ['provider' => 'skautis']) }}" class="btn btn-lg waves-effect waves-light btn-block github">SkautIS</a>
    </div>
</div>