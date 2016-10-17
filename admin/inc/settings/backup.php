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

<div class="panel panel-success">
    <div class="panel-heading">Stored backups</div>
    <div class="panel-body">
        <table class="table table-striped table-hover" id="datatable">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Date</th>
                    <th>Filename</th>
                    <th>Filesize</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $directory = new RecursiveDirectoryIterator(SCORPION_DIR_BACKUP);
                $mega = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST);
                foreach ($mega as $name => $file) {
                    if(!$file->isDir()) {
                        $fileBackupType = "";
                        $fileName = $file->getBasename();
                        if(strpos($fileName, '_S_')) {
                            $fileBackupType .= "Scorpion CMS files<br>";
                        }
                        if(strpos($fileName, '_C_')) {
                            $fileBackupType .= "Scorpion CMS custom content<br>";
                        }
                        if(strpos($fileName, '_W_')) {
                            $fileBackupType .= "Website files<br>";
                        }
                        $filePath = $file->getRealPath();
                        $fileDate = date("d-m-Y H:i:s", $file->getMTime());
                        $fileSize = number_format(($file->getSize() / 1024), 0, '', '');
                        if($fileSize > 999) {
                            $fileSize = number_format(($fileSize / 1024), 0, '', '');
                            $fileSize .= " MB";
                        }
                        else {
                            $fileSize .= " KB";
                        }
                        echo '<tr onclick="location.href=\''.SCORPION_URL.'/backup/'.$fileName.'\';">';
                        $filename = explode('_', $name);
                        echo '<td>'.$fileBackupType.'</td>';
                        echo '<td>'.$fileDate.'</td>';
                        echo '<td>'.$fileName.'</td>';
                        echo '<td>'.$fileSize.'</td>';
                        echo '<td><img src="themes/default/icons/icon-download-alt.png" alt="Download" title="Download"></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="themes/default/datatables.js"></script>
<link rel="stylesheet" href="themes/default/datatables.css" type="text/css">
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "iDisplayLength":25
    });
} );
</script>

<div class="panel panel-default">
    <div class="panel-heading">Restore backup</div>
    <div class="panel-body">
        Automatic restore of backup files will be released in a later version of Scorpion CMS.<br><br>
        In the meanwhile you'll have to manually copy files.
    </div>
</div>