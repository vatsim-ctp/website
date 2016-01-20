<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>VATSIM Cross The Pond</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" type="image/png" href="favicon.ico">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
        {!! Html::style("assets/css/bootstrap.min.css") !!}
        {!! Html::style("assets/css/coming-soon-social.css") !!}
        {!! Html::style("assets/css/main.css") !!}

        {!! Html::style("assets/css/leaflt.css") !!}
        <!--[if lte IE 8]>
            {!! Html::style("assets/css/leaflt.ie.css") !!}
        <![endif]-->

        {!! Html::script("assets/js/modernizr-2.6.2-respond-1.1.0.min.js") !!}

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->


        <div class="mainmenu-wrapper">
            <div class="container">
                @include('includes.navbar')
            </div>
        </div>

        @include("includes.slider")

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="service-wrapper">
                            <h3>What is CTP?</h3>
                            <p>
                                Cross The Pond (CTP) is a bi-annual event where pilots and controllers come together
                                to demonstrate the true potential of the VATSIM Network.
                            </p>
                            <a href="#" class="btn">View our history</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service-wrapper">
                            <h3>When does it take place?</h3>
                            <p>
                                The westbound event normally takes place in March, and the Eastbound leg occurs in October.
                                We will usually start publicising the event around 3 months prior.
                            </p>
                            <a href="#" class="btn">See the latest news</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service-wrapper">
                            <h3>Who can take part?</h3>
                            <p>
                                That's the beauty of the event... Anybody! Since it's a busy event, we do operate a booking system for departing aircraft,
                                but we warned... It will get busy!
                            </p>
                            <a href="#" class="btn">Read the beginners guide</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section section-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="calltoaction-wrapper">
                            <h3>There are still 355 flights available</h3> <a href="#" class="btn btn-orange">Book now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("includes.involvement")

        <div class="footer">
            @include("includes.footer")
        </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        {!! Html::script("assets/js/bootstrap.min.js") !!}
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        {!! Html::script("assets/js/jquery.fitvids.js") !!}
        {!! Html::script("assets/js/jquery.sequence-min.js") !!}
        {!! Html::script("assets/js/jquery.bxslider.js") !!}
        {!! Html::script("assets/js/main-menu.js") !!}
        {!! Html::script("assets/js/template.js") !!}

    </body>
</html>