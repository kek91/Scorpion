<script>
//    document.getElementById('visitors-monthly').className = 'btn btn-sm btn-primary';
//    document.getElementById('visitors-weekly').className += 'btn btn-sm btn-default';

//    alert(window.location.pathname);
</script>

<h2>Preferences</h2>

<div class="panel panel-primary">
    <div class="panel-heading">Display or hide message boxes</div>
    <div class="panel-body">
        
        Click on the buttons to toggle the display state of the specific message.<br><br>

        <script>
            var boolean_missingMetaData = localStorage.show_msg_missingMetaData !== "false" ? "Show" : "Hide";
            var boolean_betaNotice = localStorage.show_msg_betaNotice !== "false" ? "Show" : "Hide";
            var boolean_welcome = localStorage.show_msg_welcome !== "false" ? "Show" : "Hide";
            var boolean_backup = localStorage.show_msg_backup !== "false" ? "Show" : "Hide";
        </script>
        
        <button class="btn btn-default col-md-4" onClick="toggle_missingMetaData();">Missing meta data on pages/posts</button>
        <span class="col-md-2 btn" id="state_missingMetaData" onClick="toggle_missingMetaData();"><script>document.write(boolean_missingMetaData);</script></span>
        <br><br><br>
        <button class="btn btn-default col-md-4" onClick="toggle_betaNotice();">Beta statistics data warning</button>
        <span class="col-md-2 btn btn-default" id="state_betaNotice" onClick="toggle_betaNotice();"><script>document.write(boolean_betaNotice);</script></span>
        <br><br><br>
        <button class="btn btn-default col-md-4" onClick="toggle_welcome();">Welcome back at login</button>
        <span class="col-md-2 btn btn-default" id="state_welcome" onClick="toggle_welcome();"><script>document.write(boolean_welcome);</script></span>
        <br><br><br>
        <button class="btn btn-default col-md-4" onClick="toggle_backup();">Warning for backups</button>
        <span class="col-md-2 btn btn-default" id="state_backup" onClick="toggle_backup();"><script>document.write(boolean_backup);</script></span>
        <br><br><br>
        <button class="btn btn-warning col-md-4" onClick="toggle_resetall();">Reset back to default</button>
        
        <script>
            document.getElementById('state_missingMetaData').className += (localStorage.show_msg_missingMetaData !== "false" ? " btn-success" : " btn-danger");
            document.getElementById('state_betaNotice').className += (localStorage.show_msg_betaNotice !== "false" ? " btn-success" : " btn-danger");
            document.getElementById('state_welcome').className += (localStorage.show_msg_welcome !== "false" ? " btn-success" : " btn-danger");
            document.getElementById('state_backup').className += (localStorage.show_msg_backup !== "false" ? " btn-success" : " btn-danger");
        </script>

    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">Theme for Scorpion CMS Admin</div>
    <div class="panel-body">
        
        There are currently 1 theme(s) installed.<br><br>

        <b>Default</b>
        

    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">Funny quotes</div>
    <div class="panel-body">
        
        Funny quotes is a function that collects quotes from a public API
        and displays them in the login/welcome messagebox.<br><br>
        
        If the demand arises we will eventually add support to customize 
        your funny quotes or adding other APIs.<br><br>
        
        Currently quotes are queried from api.icndb.com:<br>
        <a href="http://api.icndb.com/jokes/random?limitTo=[nerdy]">
            http://api.icndb.com/jokes/random?limitTo=[nerdy]
        </a><br><br>
        
        <blockquote><div id="funny-quote"></div></blockquote>
        <a onClick="get_funny_quote();">Click here to load more funny quotes</a><br><br>
        
        <script>
            get_funny_quote();
        </script>
        
        You may disable funny quotes by hiding the "Welcome" message at login above.

    </div>
</div>