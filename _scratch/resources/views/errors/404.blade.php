@extends("layout")

@section("title")
    Page Not Found...
@overwrite

@section("content")
<div class="col-sm-12">
    <div class="error-page-wrapper">
        <p>Sorry, the page you are looking for is not here or never was...</p>
        <p>Why don't you try the {!! link_to("home", "homepage") !!}?</p>
    </div>
</div>
@overwrite