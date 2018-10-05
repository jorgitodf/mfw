<?php

$app->middleware('before', function($c) {
    session_start();
});

$app->middleware('before', function($c) {
    if (!$_SESSION && !preg_match('/^\/auth\/*./', $c['router']->getCurrentUrl())) {
        redirect("/auth/login");
    }
});

/*
$app->middleware('before', function($c) {
    header('Content-Type: application/json');
});
*/