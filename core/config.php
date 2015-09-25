<?php

$config['site_name'] = 'Scorpion';

/* The site_meta_* variables can be edited per page also */
$config['site_meta_title'] = 'Scorpion CMS';
$config['site_meta_description'] = 'Scorpion is a content management system';

$config['theme'] = 'default';

$config['cache'] = true;
$config['cache_time'] = '604800'; // 60*60*24*7, seven days (default)
 
$config['custom_setting'] = 'Hello';           // Can be accessed by {{ config.custom_setting }} in a theme
$config['site_logo'] = 'http://teknix.no/images/logo_medium.png';
$config['date_year'] = date("Y");

date_default_timezone_set('Europe/Oslo');


/* Don't remove this line */
return $config;


