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

        <div class="section section-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>@section("title") View All Flights @show</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    @section('content')
                    @show
                </div>
            </div>
        </div>

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