@extends('layouts.main')

@section('content')

    @include('partials.status-panel')

    <div class="jumbotron" style="margin-top:-20px;">
        <h1>Welcome to Laravel 5.3 Social and Email Multi-Authentication Live Demo !</h1>
        <p>This demo is related to tutorial and project from <a href="https://tuts.codingo.me/laravel-social-and-email-authentication">Codingo Tuts <i class="fa fa-external-link"></i></a></p>
        <hr>
        <p>When you see which features this Laravel boilerplate project posses it will make you say: </p></p>
        <div class="row">
            <div class="col-md-12">
                    <img class="img-fluid img-thumbnail" src="/landing/shut.gif" style="margin-bottom:20px;">
            </div>
        </div>
        <p>Aaand the best part, it is FREE!</p>

        <h2>What is covered?</h2>

        <h1><span class="tag red">Email Registration & Login</span> <span class="tag red">Social Login</span> <span class="tag red">Email Activation</span>
            <span class="tag red">Google Re-Captcha</span> <span class="tag red">User Roles</span> <span class="tag red">Redis Qeueu for emails</span> <span class="tag red">Parsley.js validation</span>
            <span class="tag red">Bootstrap 4</span> <span class="tag red">Material Design for Bootstrap</span></h1>

        <p><b>Unlimited</b> number of social providers via Socialite package. Live Demo uses:</p>
        <p style="margin-bottom:15px;">
        <span class="tag green">Facebook</span>
        <span class="tag green">Twitter</span>
        <span class="tag green">Google+</span>
        <span class="tag green">GitHub</span>
        </p>

        <p>Via <a href="https://socialiteproviders.github.io/" target="_blank">Socilite Providers</a> you can easily enable following OAuth logins:
        <span class="tag grey">23andme</span>
        <span class="tag grey">37Signals</span>
        <span class="tag grey">500px</span>
        <span class="tag grey">AngelList</span>
        <span class="tag grey">App.net</span>
        <span class="tag grey">Asana</span>
        <span class="tag grey">Bit.ly</span>
        <span class="tag grey">Box</span>
        <span class="tag grey">Buffer</span>
        <span class="tag grey">CampaignMonitor</span>
        <span class="tag grey">Cheddar</span>
        <span class="tag grey">Coinbase</span>
        <span class="tag grey">ConstantContact</span>
        <span class="tag grey">Coursera</span>
        <span class="tag grey">Dailymile</span>
        <span class="tag grey">Dailymotion</span>
        <span class="tag grey">Deezer</span>
        <span class="tag grey">devianART</span>
        <span class="tag grey">DigitalOcean</span>
        <span class="tag grey">Discord</span>
        <span class="tag grey">Disqus</span>
        <span class="tag grey">Douban</span>
        <span class="tag grey">Dribble</span>
        <span class="tag grey">Dropbox</span>
        <span class="tag grey">Envato</span>
        <span class="tag grey">Etsy</span>
        <span class="tag grey">Eventbrite</span>
        <span class="tag grey">Everyplay</span>
        <span class="tag grey">EyeEm</span>
        <span class="tag grey">Fitbit</span>
        <span class="tag grey">Flickr</span>
        <span class="tag grey">Foursquare</span>
        <span class="tag grey">GitLab</span>
        <span class="tag grey">Goodreads</span>
        <span class="tag grey">Heroku</span>
        <span class="tag grey">Hitbox</span>
        <span class="tag grey">Human API</span>
        <span class="tag grey">Imgur</span>
        <span class="tag grey">Instagram</span>
        <span class="tag grey">Jawbone</span>
        <span class="tag grey">Jira</span>
        <span class="tag grey">Kakao</span>
        <span class="tag grey">LinkedIn</span>
        <span class="tag grey">MailChimp</span>
        <span class="tag grey">Medium</span>
        <span class="tag grey">Meetup</span>
        <span class="tag grey">Microsoft Azure</span>
        <span class="tag grey">Microsoft Live</span>
        <span class="tag grey">Mixcloud</span>
        <span class="tag grey">Moves</span>
        <span class="tag grey">Naver</span>
        <span class="tag grey">Paymill</span>
        <span class="tag grey">PayPal</span>
        <span class="tag grey">Pinterest</span>
        <span class="tag grey">Podio</span>
        <span class="tag grey">Pushbullet</span>
        <span class="tag grey">QQ</span>
        <span class="tag grey">Rdio</span>
        <span class="tag grey">Readability</span>
        <span class="tag grey">Reddit</span>
        <span class="tag grey">RunKeeper</span>
        <span class="tag grey">SalesForce</span>
        <span class="tag grey">Slack</span>
        <span class="tag grey">SoundCloud</span>
        <span class="tag grey">SharePoint</span>
        <span class="tag grey">Spotify</span>
        <span class="tag grey">StackExchange</span>
        <span class="tag grey">Steam</span>
        <span class="tag grey">StockTwits</span>
        <span class="tag grey">Strava</span>
        <span class="tag grey">Stripe</span>
        <span class="tag grey">Trello</span>
        <span class="tag grey">Tumblr</span>
        <span class="tag grey">Twitch</span>
        <span class="tag grey">Uber</span>
        <span class="tag grey">Venmo</span>
        <span class="tag grey">VersionOne</span>
        <span class="tag grey">Vimeo</span>
        <span class="tag grey">VKontakte</span>
        <span class="tag grey">Weibo</span>
        <span class="tag grey">Weixin</span>
        <span class="tag grey">WordPress</span>
        <span class="tag grey">Xing</span>
        <span class="tag grey">xREL</span>
        <span class="tag grey">Yahoo</span>
        <span class="tag grey">Yammer</span>
        <span class="tag grey">Yandex</span>
        <span class="tag grey">YouTube</span>
        <span class="tag grey">Zendesk</span>
        </p>

        <div class="headline">
            <h2>Adding new Social provider easy as copy/paste login button</h2>
        </div>

        <p>Checkout example file where you add new buttons:</p>

        <script src="https://gist.github.com/ivanderbu2/a3703b455981521e79add5bdead4b6d1.js"></script>

        <p>After this you only need to add OAuth keys to <code>services.php</code> config file:</p>

        <script src="https://gist.github.com/ivanderbu2/fae7d5d42a08053099d7fdb63d9c24bd.js"></script>

        <p><a class="btn btn-primary btn-lg" href="{{url('register')}}" role="button">Try Register Feature</a></p>

        <p>If you have any improvements or ideas please post comments here: <a href="https://tuts.codingo.me/laravel-social-and-email-authentication#disqus_thread">Laravel 5.3 Social and Email Multi-Authentication</a></p>
    </div>

@stop