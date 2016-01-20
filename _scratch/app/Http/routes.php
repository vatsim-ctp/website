<?php

Route::get("/home", function(){ return View::make("home"); });
Route::get("/flightslist", function(){ return View::make("flightlist"); });
Route::get("/bookinglist", function(){ return View::make("bookinglist"); });
Route::get("/news", function(){ return View::make("news"); });
Route::get("/faq", function(){ return View::make("faq"); });
Route::get("/history", function(){ return View::make("history"); });


Route::get("/landing", ["as" => "landing", "uses" => "Site\Homepage@getLanding"]);
Route::post("/landing", ["as" => "landing", "uses" => "Site\Homepage@postLandingSubscribe"]);
Route::get("/", ["uses" => "Site\Homepage@getLanding"]);