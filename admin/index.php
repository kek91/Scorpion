<?php
include_once("../core/init.php");
echo '<h1>Scorpion CMS Admin</h1>';

$url = explode('/', $_SERVER['REQUEST_URI']);
$url = escape($url[count($url)-1]);

echo $url;

echo '<br><br>';

print_r($_SERVER['REQUEST_URI']);

echo '<pre>';
print_r($_SERVER);
echo '</pre>';

echo '<br><br>';
echo 'Hallo...';

//include_once("core/init.php");
//
//
////include_once("resources/header.php");
//
//if(Session::exists("error")) {
//    echo '<div class="unsuccessful">'.Session::flash("error").'</div>';
//}
//
//$user = new User();
//if($user->isLoggedIn()) {
//    Redirect::to("main.php");
//}
//else {
//    include("inc/login.php");
//}
//
//include_once("resources/footer.php");