<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>VATSIM {{ $_event->name }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

        <script src="{{ elixir('js/app.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div>
            <?php $random = rand(1,8); ?>
            @for($i=1; $i<=8; $i++)
            {!! Html::image("assets/images/coming-soon/coming_soon_".$i.".jpg", "", ["class" => "full-screen-background".($random==$i ? " start" : ""), "id" => "bg-cycle-".$i, "style" => ($random!=$i ? "display:none;" : "")]) !!}
            @endfor
        </div>

        <div class="coming-soon-content">
            <h3>We're busy planning {{ $_event->name }}!</h3>


            <div class="coming-soon-subscribe container">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        @if(!isset($alreadySubscribed) OR !$alreadySubscribed)
                        {!! Form::open(["route" => "newsletter.subscribe", "method" => "POST"]) !!}
                            <div class="input-group">
                                <input type="text" class="form-control input-lg" placeholder="Please enter your email" name='email' id="email">

                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-lg">Subscribe</button>
                                </span>

                            </div>
                        {!! Form::close() !!}
                        @if(count($errors) > 0)
                        &nbsp;
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                Enter a valid email address
                            </div>
                        @endif
                        <p>Subscribe for Cross The Pond news and updates!</p>
                        @else
                        <p>Thanks for subscribing! We will send any news directly to your inbox.</p>
                        @endif
                    </div>
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="coming-soon-social">
                            <a href="http://www.twitter.com/vatsimctp" target="_blank" data-toggle="tooltip" data-original-title="Join Us!" data-placement="top" class="show-tooltip">
                                <i class="icon-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Javascripts -->
        <script>
            $('.show-tooltip').tooltip();

            var firstTime = true;
            $(window).on('load', function() {
                $(".full-screen-background.start").first().show(1, function showNext() {
                    var next = $(this).next('img').length ? $(this).next('img') : $(".full-screen-background").first();
                    if (firstTime) {
                        $(this).siblings().delay(7000);
                        firstTime = false;
                    } else {
                        $(this).siblings().fadeOut('slow').delay(7000);
                    }
                    next.fadeIn("slow", showNext);
                });
            })
        </script>

    </body>
</html>
