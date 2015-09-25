<?php
include_once("core/init.php");
include_once("resources/header.php");

$user = new User();
if(!$user->isLoggedIn()) {
    Session::flash("error","Du må være logget inn for å se denne siden.");
    Redirect::to("index.php");
}

if(Session::exists("error")) {
    echo '<div class="unsuccessful">'.Session::flash("error").'</div>';
}

$page = isset($_GET['page']) ? $_GET['page'] : "";
$def = "dashboard";
$dir = "inc";
$ext = "php";

if (!empty($page))
{
    $page = substr(strtolower(preg_replace('([^a-zA-Z0-9-/])', '', $page)), 0, 20);
    if (file_exists("$dir/$page.$ext") && is_readable("$dir/$page.$ext") && $page != "index")
        include("$dir/$page.$ext");
    else
        include("$dir/errors/404.php");
}
else
    include("$dir/$def.$ext");

include_once("resources/footer.php");
