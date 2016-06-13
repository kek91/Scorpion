<h1>Settings</h1>

<div id="settingmenu">
    <a href="settings/preferences"><button class="btn btn-primary">Preferences</button></a>
    <a href="settings/account"><button class="btn btn-default">Account</button></a>
    <a href="settings/users"><button class="btn btn-default">User administration</button></a>
    <a href="settings/system"><button class="btn btn-default">System configuration</button></a>
    <a href="settings/logs"><button class="btn btn-default">Logs</button></a>
    <a href="settings/backup"><button class="btn btn-default">Backup</button></a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var request_uri = window.location.pathname.split('/').pop();
    
    var els = document.getElementsByClassName("btn");
    var searchValue = request_uri;

    for(var i = 0; i < els.length; i++){
      if(els[i].innerHTML.indexOf(searchValue) > -1){
        this.parentNode.className += ' active';
      }
    }
    
//    document.getElementById('settingmenu')$('# a[href="' + permalink_nodomain + '"]').parents('li').addClass('active');
//    });
})
</script>
<?php
if(isset($subpage)) {
    if($subpage == "account") {
        include("settings/account.php");
    }
    if($subpage == "preferences") {
        include("settings/preferences.php");
    }
    elseif($subpage == "users") {
        include("settings/users.php");
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
}
else {
    include("settings/preferences.php");
}










