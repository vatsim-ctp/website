@extends('layout')

@section("title")
News &amp; Updates
@overwrite

@section("content")
<div class="col-md-7 latest-news">
    <h2>Latest News</h2>
    <div class="row">
        <div class="col-xs-4"><a href="page-blog-post-right-sidebar.html"><img src="img/news1.jpg" alt="Post Title"></a></div>
        <div class="col-xs-8">
            <div class="caption"><a href="page-blog-post-right-sidebar.html">Anual Report</a></div>
            <div class="date">16 May 2013 </div>
            <div class="intro">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. <a href="page-blog-post-right-sidebar.html">Read more...</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"><a href="page-blog-post-right-sidebar.html"><img src="img/news2.jpg" alt="Post Title"></a></div>
        <div class="col-xs-8">
            <div class="caption"><a href="page-blog-post-right-sidebar.html">New Career Oportunities</a></div>
            <div class="date">14 May 2013 </div>
            <div class="intro">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <a href="page-blog-post-right-sidebar.html">Read more...</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"><a href="page-blog-post-right-sidebar.html"><img src="img/news3.jpg" alt="Post Title"></a></div>
        <div class="col-xs-8">
            <div class="caption"><a href="page-blog-post-right-sidebar.html">Even More News</a></div>
            <div class="date">05 May 2013 </div>
            <div class="intro">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <a href="page-blog-post-right-sidebar.html">Read more...</a></div>
        </div>
    </div>
</div>
<div class="col-md-5">
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