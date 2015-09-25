<?php
if(isset($_GET['page']))
{
    $getPageName = ucwords(htmlentities($_GET['page'], ENT_QUOTES, 'UTF-8'));
    $title = $getPageName . ' - ';
}
else $title = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Nødlysteknikk">
    <meta name="keywords" content="Nødlysteknikk">
    <meta name="author" content="Teknix">
    <title><?php echo $title; ?>Nødlysteknikk</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="resources/nodlys.css"> 
    <script src="resources/nodlys.js"></script>
    <!-- <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="resources/logo/favicon.ico">
    <link rel="icon" href="resources/logo/tekcms_50x50.png"> -->
</head>
<body>

    <header>
        <div>
            <p class="left">Administrasjonspanel Nødlysteknikk AS</p>
            <p class="right">v0.1.0</p>
        </div>
    </header>
    
    <nav>
        <ul>
            <?php
            /*if(isset($_SESSION['cred'])) {*/
            $user = new User();
            if($user->isLoggedIn()) {
            ?>
                <li><a href="?page=settings"><b><?php echo $user->data()->name; ?></b></a></li>
                <li><a href="?page=dashboard">Oversikt</a></li>
                <li><a href="?page=map">Kart</a></li>
                <li><a href="?page=centrals">Sentraler</a></li>
                <li><a href="?page=fixtures">Armaturer</a></li>
                <li><a href="?page=canlog">CAN logg</a></li>
                <li><a href="?page=settings">Innstillinger</a></li>
                <li><a href="?page=logout">Logg ut</a></li>
            <?php
                if($user->data()->siteid == "0") {
            ?>
                <br style="margin:100px 0;">
                <li><a style="text-align:center;text-indent:0%;">Site</a></li>
                <li><select>
                        <option value="Margrethe Stiftelsen">Margrethe Stiftelsen</option>
                        <option value="Sørlandssenteret">Sørlandssenteret</option>
                        <option value="HiA">HiA</option>
                        <option value="Longum park">Longum park</option>
                    </select>
                </li>
                <?php
                }
            }
            else {
            ?>
                <li><a href="#">Glemt passord?</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    
    <section id="content">
        
