<?php

$app->middleware('before', function($c) {
    session_start();
});

$app->middleware('before', function($c) {
    if (!$_SESSION && $c['router']->getCurrentUrl() == '/') {
        redirect("/login");
    };
});

/*
$app->middleware('before', function($c) {
    header('Content-Type: application/json');
});
*/