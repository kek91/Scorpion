<h2>Backup</h2>

<div class="alert alert-warning hidden" id="infobox_backup">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b>Warning</b><br><br>
    Please note Scorpion CMS can not be held responsible for any corrupt files/backups.<br>
    You should always ensure you have a proper backup process and verify that it actually works.<br><br>
    <button class="btn btn-sm btn-warning" onClick='dont_show_again_backup();'>Don't show again</button>
</div>
<script>
    if(localStorage.show_msg_backup !== "false") {
        document.getElementById('infobox_backup').className = 'alert alert-warning';
    }
</script>

<div class="panel panel-primary">
    <div class="panel-heading">Automatic scheduler</div>
    <div class="panel-body">
        You currently have no scheduled backups.<br><br>
        <button class="btn btn-default" onClick="bak_schedule();">Setup automatic scheduler</button>
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">Manual backup</div>
    <div class="panel-body">
        Starting a manual backup may cause big I/O bandwidth and ultimately slow down your website.<br>
        Please use with caution and not during peak hours.
        <br>
        <form id="manualbackup" action="#" method="post">
            <div class="checkbox">
                <label class="label-w200"><input type="checkbox" name="backupdata[]" value="Scorpion">Scorpion CMS files</label> (includes everything under the /scorpion directory)
            </div>
            <div class="checkbox">
                <label class="label-w200"><input type="checkbox" name="backupdata[]" value="Content">Scorpion CMS custom content</label> (/scorpion/content directory and sub-directories)
            </div>
            <div class="checkbox">
                <label class="label-w200"><input type="checkbox" name="backupdata[]" value="Website" disabled>Website files</label> (must be configured in <a href="settings/system">System configuration</a> page prior to backup!)
            </div>
            <input type="submit" class="btn btn-danger" value="Start backup">
        </form>
        <br>
        <div id="manualbackup_result"></div>
    </div>
</div>

<script>
//    document.querySelector('input[value=Scorpion]').addEventListener('click', function(e) {
//        document.querySelector('input[value=Content]').setAttribute('disabled', 'disabled');
//    });
</script>