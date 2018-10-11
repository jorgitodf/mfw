<?php

$app->middleware('before', function($c) {
    session_start();
});

$app->middleware('before', function($c) {
    if (!$_SESSION && !preg_match('/^\/auth\/*./', $c['router']->getCurrentUrl())) {
        redirect("/auth/login");

    } 
    if (!$_SESSION["hasConta"] && $c['router']->getCurrentUrl() != '/' && !preg_match('/^\/auth\/*./', $c['router']->getCurrentUrl())) {
        redirect("/");
    }
});

/*
$app->middleware('before', function($c) {
    header('Content-Type: application/json');
});
*/