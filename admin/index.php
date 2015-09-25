<?php
include_once("core/init.php");


//include_once("resources/header.php");

if(Session::exists("error")) {
    echo '<div class="unsuccessful">'.Session::flash("error").'</div>';
}

$user = new User();
if($user->isLoggedIn()) {
    Redirect::to("main.php");
}
else {
    include("inc/login.php");
}

include_once("resources/footer.php");