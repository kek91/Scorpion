<?php
//echo phpinfo();
//$url = explode('/', $_SERVER['REQUEST_URI']);
//$url = escape($url[count($url)-1]);
include_once("../core/init.php");

$user = new User();
if($user->isLoggedIn()) {
    $userdata = $user->data();
    include_once("themes/default/header.html");
    echo '<h2>Welcome back, '.$userdata->name.'!</h2>';
}
else {
    include_once("themes/default/header-loggedout.html");
    include("inc/login.php");
}

include_once("themes/default/footer.html");