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
    var els = document.getElementsByClassName("btn");
//    console.log(request_uri);
//    console.log(els);
    for(var i = 0; i < els.length; i++){
//        console.log(els[i]);
//        console.log(els[i].innerHTML.toLowerCase());
        if(els[i].innerHTML.toLowerCase().indexOf(request_uri) > -1) {
    //        this.parentNode.className += ' active';
//            this.className += ' active';
            els[i].className += ' active';
            console.log('match found!'+els[i].innerHTML);
//            console.log('this: ' + this);
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










