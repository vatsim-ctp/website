<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
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
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->

<div>
    <?php $random = rand(1, 8); ?>
    @for($i=1; $i<=8; $i++)
        {!! Html::image("assets/images/coming-soon/coming_soon_".$i.".jpg", "", ["class" => "full-screen-background".($random==$i ? " start" : ""), "id" => "bg-cycle-".$i, "style" => ($random!=$i ? "display:none;" : "")]) !!}
    @endfor
</div>

<div class="voting-content">
    <h3>Voting is open - have your say!</h3>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-5" style="background-color: #f5f5f5;">
                    <h2>Departures</h2>
                    @if($canVoteOnDeparture)
                        <p>
                            Please cast your vote for your chosen departure airfield. Remember, <strong>you can only vote
                                once</strong> and it <strong>is not possible</strong> to change your vote after voting.
                        </p>
                    @else
                        <p>Thank you for your vote!</p>
                    @endif

                    @include("site.voting._list", ["airfields" => $departureAirfields, "canVote" => $canVoteOnDeparture])
                </div>
                <div class="col-md-5 col-md-offset-2" style="background-color: #f5f5f5;">
                    <h2>ARRIVALS</h2>
                    @if($canVoteOnArrival)
                        <p>
                            Please cast your vote for your chosen arrival airfield. Remember, <strong>you can only vote
                                once</strong> and it <strong>is not possible</strong> to change your vote after voting.
                        </p>
                    @else
                        <p>Thank you for your vote!</p>
                    @endif

                    @include("site.voting._list", ["airfields" => $arrivalAirfields, "canVote" => $canVoteOnArrival])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascripts -->
<script>
    $('.show-tooltip').tooltip();

    var firstTime = true;
    $(window).on('load', function () {
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
