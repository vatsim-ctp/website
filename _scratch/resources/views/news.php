@extends('layout')

@section("title")
    News &amp; Updates
@overwrite

@section("content")
<div class="col-md-8">Some news goes here...</div>
<div class="col-md-4">
    <a class="twitter-timeline" href="https://twitter.com/hashtag/vatsimctp" data-widget-id="582329976873213953" width="1024">#vatsimctp Tweets</a>
    <script>!function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + "://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");</script>

</div>
@overwrite