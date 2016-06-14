<script>
//    document.getElementById('visitors-monthly').className = 'btn btn-sm btn-primary';
//    document.getElementById('visitors-weekly').className += 'btn btn-sm btn-default';

//    alert(window.location.pathname);
</script>

<h2>Preferences</h2>

<div class="panel panel-default">
    <div class="panel-heading">Display or hide message boxes</div>
    <div class="panel-body">
        
        Click on the buttons to toggle the display state of the specific message.<br><br>

        <script>
            var boolean_missingMetaData = localStorage.show_msg_missingMetaData !== "false" ? "Show" : "Hide";
            var boolean_betaNotice = localStorage.show_msg_betaNotice !== "false" ? "Show" : "Hide";
            var boolean_welcome = localStorage.show_msg_welcome !== "false" ? "Show" : "Hide";
        </script>
        
        <button class="btn btn-default w300" onClick="toggle_missingMetaData();">Missing meta data on pages/posts</button>
        <span id="state_missingMetaData"><script>document.write(boolean_missingMetaData);</script></span>
        
        <br><br>
        <button class="btn btn-default w300" onClick="toggle_betaNotice();">Beta statistics data warning</button>
        <span id="state_betaNotice"><script>document.write(boolean_betaNotice);</script></span>
        
        <br><br>
        <button class="btn btn-default w300" onClick="toggle_welcome();">Welcome back at login</button>
        <span id="state_welcome"><script>document.write(boolean_welcome);</script></span>
        

    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">Theme for Scorpion CMS Admin</div>
    <div class="panel-body">
        
        There are currently 1 theme(s) installed.<br><br>

        <b>Default</b>
        

    </div>
</div>