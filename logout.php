<?php

include("php/session.php");


if ($auth->isLogged()) {

    $hash=$_COOKIE[$auth->config->cookie_name];
    $uid = $auth->getSessionUID($hash);
    $user = $auth->getUser($uid);

    $auth->logout($hash);



}

$url = 'http://' . $_SERVER['HTTP_HOST'];            // Get the server
$url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
$url .= '/login.php';            // <-- Your relative path
header('Location: ' . $url, true, 302);
exit();

?>
