<?php 
session_start();

define('SCORPION_DEVMODE', false);
define('SCORPION_DIR_ROOT', realpath(__DIR__ . '/..') . '/');
define('SCORPION_DIR_CONTENT', SCORPION_DIR_ROOT.'content/');
define('SCORPION_DIR_UPLOAD', SCORPION_DIR_ROOT.'content/upload/');
define('SCORPION_DIR_CACHE', SCORPION_DIR_ROOT.'content/cache/');
define('SCORPION_DIR_THEMES', SCORPION_DIR_ROOT.'themes/');
define('SCORPION_SESSION', 'cred');
define('SCORPION_TOKEN', 'token');
define('SCORPION_VERSION_MAJOR', 0);
define('SCORPION_VERSION_MINOR', 1);
define('SCORPION_VERSION_PATCH', 0);

require_once('config.php');
require_once('users.php');

if(SCORPION_DEVMODE) {
    error_reporting(E_ALL);
    echo '<pre>Dev mode enabled<br>';
    print_r(SCORPION_DIR_ROOT);
    echo '<br>';
    print_r(SCORPION_DIR_CONTENT);
    echo '<br>';
    print_r(SCORPION_DIR_UPLOAD);
    echo '<br>';
    print_r(SCORPION_DIR_CACHE);
    echo '<br>';
//    echo 'Scorpion::get_template_file() = ' . Scorpion::get('template_file') . '<br>';
    echo '</pre>';
}

spl_autoload_register(function($class) {
    require_once(dirname(__DIR__)."/classes/".$class.".php");
});

function escape($str) {
    return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8');
}