<?php
include_once("../core/init.php");
include_once("themes/default/header.html");

$url = explode('/', $_SERVER['REQUEST_URI']);
$url = escape($url[count($url)-1]);

$user = new User("kek");
$userdata = $user->data();

echo '<br><br>';

echo $userdata->username;
echo '<br>';
//echo $user->data()->username;

echo '<pre>';
print_r($user->data());
echo '</pre>';

echo '<br><br>';

echo $url;

echo '<br><br>';

print_r($_SERVER['REQUEST_URI']);

echo '<pre>';
print_r($_SERVER);
echo '</pre>';

echo '<br><br>';



include_once("themes/default/footer.html");