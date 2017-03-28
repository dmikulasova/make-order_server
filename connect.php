<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

$method = $_SERVER['REQUEST_METHOD'];

// connect to the mysql database
$link = mysqli_connect('localhost', 'id1140352_localhost', 'password', 'id1140352_make_order');
mysqli_set_charset($link,'utf8');

if ($link->connect_errno) {
    printf ("Connect failed: %s\n", $link->connect_error);
    exit(1);
}


?>
