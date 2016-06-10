<?php
include_once("../core/init.php");

$user = new User();

include_once("themes/default/header.php");

if($user->isLoggedIn()) {
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $url = escape($url[count($url)-1]);
    
    if($url == "dashboard") {
        include_once("inc/dashboard.php");
    }
    elseif($url == "posts") {
        include_once("inc/posts.php");
    }
    elseif($url == "pages") {
        include_once("inc/pages.php");
    }
    elseif($url == "media") {
        include_once("inc/media.php");
    }
    elseif($url == "settings") {
        include_once("inc/settings.php");
    }
    elseif($url == "logout") {
        include_once("inc/logout.php");
    }  
}
else {
    include("inc/login.php");
}

include_once("themes/default/footer.html");