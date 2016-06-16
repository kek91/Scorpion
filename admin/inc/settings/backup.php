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