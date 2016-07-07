<?php
include_once("../core/init.php");

$user = new User();

include_once("themes/default/header.html");
include_once("inc/modules/nav.php");
include_once("themes/default/header2.html");
include_once("inc/modules/showmessages.php");


if($user->isLoggedIn()) {
    $url = explode('/', $_SERVER['REQUEST_URI']);
    if(count($url) === 5) {
        $page = escape($url[count($url)-2]);
        $subpage = escape($url[count($url)-1]);
    }
    else {
        $page = escape($url[count($url)-1]);
    }
            
    if($page == "dashboard") {
        include_once("inc/dashboard.php");
    }
    elseif($page == "posts") {
        include_once("inc/posts.php");
    }
    elseif($page == "pages") {
        include_once("inc/pages.php");
    }
    elseif($page == "media") {
        include_once("inc/media.php");
    }
    elseif($page == "settings") {
        include_once("inc/settings.php");
    }
    elseif($page == "logout") {
        include_once("inc/logout.php");
    }
    elseif($page == "export-sysinfo") {
        Redirect::to('sysinfo.php');
    }
    else {
        include_once("inc/dashboard.php");
    }
}
else {
    include("inc/login.php");
}

include_once("themes/default/footer.html");