<h1>Settings</h1>

<a href="settings/account"><button class="btn btn-primary">Account preferences</button></a>
<a href="settings/users"><button class="btn btn-default">User administration</button></a>
<a href="settings/system"><button class="btn btn-default">System configuration</button></a>

<?php
if(isset($subpage)) {
    if($subpage == "account") {
        include("subsettings/account.php");
    }
    elseif($subpage == "users") {
        include("subsettings/users.php");
    }
    elseif($subpage == "system") {
        include("subsettings/system.php");
    }
}
else {
    include("subsettings/account.php");
}











