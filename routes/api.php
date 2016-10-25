<?php

use Illuminate\Http\Request;

Route::group(["middleware" => "api", "as" => "api.", "namespace" => "Api"], function(){
    Route::get("status", [
        "as" => "status",
        "uses" => "Status@getStatus",
    ]);
});
