<?php
include_once("core/init.php");

/* 
 * Initiate Scorpion CMS 
 */
$scorpion = new Scorpion();

/* 
 * Configuration options 
 */

$scorpion->set_config('header_title', 'Scorpion CMS');
$scorpion->set_config('header_slogan', 'Sure is');
$scorpion->set_config('header_logo', 'path/to/logo.png');

/*
 * If you specify a theme that doesnt exist 
 * it will revert back to default.
 * Your theme must be created as a folder in /scorpion/themes/<themename>
 * and it must have a index.html and a style.css
 */
$scorpion->set_config('theme', 'default');

/*
 * Create the navigation. Add them in the order you'd like them to show.
 * Please note that the links you add must also have a .md file in the /scorpion/content/ folder.
 * Scorpion will automatically find the corresponding filename so you don't have to enter filepaths or .md extension etc.
 * 
 * For the default links below, Scorpion will look for /scorpion/content/home.md, about.md, contact.md, references.md, source.md and contact.md
 * 
 * After setting the config 'navigation' field you may show the navigation in your theme file by simply writing {{ navigation }}
 */
$scorpion->set_config('navigation', 'Home, Download, Screenshots, Docs, Source');

/*
 * Chose what navigation link should lead to your index.md file
 */
$scorpion->set_config('index', 'Home');

/*
 * Enabling caching will reduce server resources
 * and speed up loading times for your users.
 * It should be turned off in development, or else you won't see content changes.
 */
$scorpion->set_config('cache', 'false');
$scorpion->set_config('cache_time', '604800'); /* In seconds. 60*60*24*7 = 604800 (7 days) */

/*
 * You may change how to output dates.
 * See instructions here: http://php.net/manual/en/function.date.php
 */
$scorpion->set_config('date_year', date("Y"));
$scorpion->set_config('date', date("d.m.Y H:i:s"));

/*
 * Add as many custom variables as you wish.
 * These can be accessed in your theme file later.
 */
$scorpion->set_config('custom1', 'Hello'); /* This can be outputted in your theme using template code: {{ custom1 }} */
$scorpion->set_config('custom2', 'World'); /* This can be outputted in your theme using template code: {{ custom2 }} */

/* 
 * Set timezone to your desired location.
 * See list here for supported timezones: http://php.net/manual/en/timezones.php 
 */
date_default_timezone_set('Europe/Oslo');


/* 
 * And lastly, let's fire up the engine! 
 */
$scorpion->show();