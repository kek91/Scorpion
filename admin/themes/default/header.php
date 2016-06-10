<!DOCTYPE html>
<html>
    <head>
        <title>ScorpionCMS Admin</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="themes/default/bootstrap.yeti.min.css" type="text/css">
        <link rel="stylesheet" href="themes/default/style.css" type="text/css">
        <script src="themes/default/default.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <header>
            <div class="inner">
                <h1><a href="dashboard">Scorpion CMS Web Admin</a></h1>
                <nav>
                    <ul>
                        <?php
                        if($user->isLoggedIn()) {
                        ?>    
                        <li><a href="dashboard">dashboard</a></li>
                        <li><a href="posts">posts</a></li>
                        <li><a href="pages">pages</a></li>
                        <li><a href="media">media</a></li>
                        <li><a href="settings">settings</a></li>
                        <li><a href="logout">logout</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a href="login">login</a></li>
                        <li><a href="../index">go back to website</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <div class="clearboth"></div>
            </div>
	</header>

	<section>
            <div class="inner">
                <?php
                if(isset($_SESSION['error'])) {
                    echo '<div class="alert alert-dismissable alert-danger" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    echo $_SESSION['error'];
                    echo '</div>';
                    $_SESSION['error'] = null;
                }
                if(isset($_SESSION['welcome'])) {
                    echo '<div class="alert alert-dismissable alert-success" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    echo $_SESSION['welcome'];
                    echo '</div>';
                    $_SESSION['welcome'] = null;
                }
                ?>
            