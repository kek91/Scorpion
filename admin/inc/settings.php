<h1>Innstillinger</h1>
 
<a href="?page=settings&opt=account"><button>Konto</button></a>
<?php 
if($user->hasPermission("operator")) { ?>
    <a href="?page=settings&opt=sites"><button>Sites</button></a>
<?php }
if($user->hasPermission("administrator")) { ?>
    <a href="?page=settings&opt=users"><button>Brukere</button></a>
    <a href="?page=settings&opt=system"><button>System</button></a>
<?php } ?>
<br><br>
    
<?php
if(!empty($_GET['opt'])) {
    if($_GET['opt'] == "account")
        include("settings/account.php");
    elseif($_GET['opt'] == "sites")
        include("settings/sites.php");
    elseif($_GET['opt'] == "users")
        include("settings/users.php");
    elseif($_GET['opt'] == "system")
        include("settings/system.php");
    else
        include("settings/account.php");
}
else {
    include("settings/account.php");
}

