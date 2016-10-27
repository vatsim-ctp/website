@extends("admin._layout._master")

@section("title")
    Dashboard
@stop

@section("content")
    @include("admin.dashboard._statsboxes")
@stop