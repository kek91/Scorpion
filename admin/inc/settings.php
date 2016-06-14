<h1>Settings</h1>

<div id="settingmenu">
    <a href="settings/preferences"><button class="btn btn-primary">Preferences</button></a>
    <a href="settings/account"><button class="btn btn-primary">Account</button></a>
    <a href="settings/user"><button class="btn btn-primary">User administration</button></a>
    <a href="settings/system"><button class="btn btn-primary">System configuration</button></a>
    <a href="settings/logs"><button class="btn btn-primary">Logs</button></a>
    <a href="settings/backup"><button class="btn btn-primary">Backup</button></a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var request_uri = window.location.pathname.split('/').pop();
    if(request_uri == "") {
        request_uri = "preferences";
    }
    var els = document.getElementsByClassName("btn");
    for(var i = 0; i < els.length; i++){
        if(els[i].innerHTML.toLowerCase().indexOf(request_uri) > -1) {
            els[i].className += ' active';
        }
    }
})
</script>
<?php
if(isset($subpage)) {
    if($subpage == "preferences") {
        include("settings/preferences.php");
    }
    elseif($subpage == "account") {
        include("settings/account.php");
    }
    elseif($subpage == "user") {
        include("settings/user.php");
    }
    elseif($subpage == "system") {
        include("settings/system.php");
    }
    elseif($subpage == "logs") {
        include("settings/logs.php");
    }
    elseif($subpage == "backup") {
        include("settings/backup.php");
    }
    else {
        include("settings/preferences.php");
    }
}
else {
    include("settings/preferences.php");
}










