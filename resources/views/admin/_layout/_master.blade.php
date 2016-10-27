<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <title>ADMIN :: {{ setting("event", "name") }}</title>

    <link rel="stylesheet" href="{{ elixir('css/admin.css') }}">
    <script src="{{ elixir('js/admin.js') }}"></script>

    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@include("admin._layout._header")

@include("admin._layout._navbar")

@include("admin._layout._content")

@include("admin._layout._footer")

<script>
    @section('scripts')
        function updateStatus() {
            $.get("{{ route("api.status") }}", function (data, status) {
                $("#currentStatus").html("Status: <strong>" + data.verbose + "</strong>");
            });
        }

        $(window).on('load', function () {
            updateStatus();
            setInterval(updateStatus, 3000);
        });
    @show
</script>

</body>
</html>
