<?php

$app->middleware('before', function($c) {
    session_start();
});

$app->middleware('before', function($c) {
    $url = $c['router']->getCurrentUrl();
    if (!$_SESSION && ($url == '/')) {
        redirect("/auth/login");
    };
});

/*
$app->middleware('before', function($c) {
    header('Content-Type: application/json');
});
*/