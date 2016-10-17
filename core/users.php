<?php
/*
 * You can add new users through the web admin GUI or manually by adding a new sub-array below.
 * 
 * If entering users manually you must hash the password with PHPs password_hash() function using the latest available algorithm:
 * echo password_hash('yourpassword', PASSWORD_DEFAULT);
 * 
 * Also try using only regular alphacharacters (A-Z) for the username field...  
 * or else the world might implode and shatter into a thousand pieces. You have been warned.
 */
$GLOBALS['CONFIG']['SCORPION_USERS'] = [
    [
        'username' => 'kek',
        'email' => 'kek@teknix.no',
        'name' => 'Kim Eirik Kvassheim',
        'password' => '$2y$10$UXO7zWaNcEWEVZkoyimwxOkSnrdZw.RLvXmzsH/gl/1wMucDtZygi',
        'avatar' => '',
        'about' => '',
        'permission' => ''
    ],
    [
        'username' => 'demo',
        'email' => 'demo@example.com',
        'name' => 'Demo User',
        'password' => '$2y$10$cMG.I1AqmpAWO6iw1oGXeOepq/Ozr/8DgAv37SxaklO2CkAW0AeFO'
    ]
];