<?php
function byte_converter($bytes) {
    $type = array("", "K", "M", "G", "T", "P", "E", "Z", "Y");
    $i = 0;
    while($bytes >= 1024) {
        $bytes /= 1024;
        $i++;
    }
    return(number_format($bytes, '2', '.', ',').' '.$type[$i]."B");
}

function remove_decimals($number) {
    return number_format($number, '2', '.', ',');
}

/* Check Scorpion CMS version */
//$official_Scorpion_version = file_get_contents('http://example.com/v');
$official_Scorpion_version = '0.1.0';
$local_Scorpion_version = SCORPION_VERSION_MAJOR.'.'.SCORPION_VERSION_MINOR.'.'.SCORPION_VERSION_PATCH;
if($official_Scorpion_version != $local_Scorpion_version) {
    
}

/* Get disk statistics */
$ds = disk_total_space(SCORPION_DIR_ROOT);
$df = disk_free_space(SCORPION_DIR_ROOT);
$used = $ds - $df;
$percentage_used = remove_decimals(($used / $ds) * 100);
$percentage_free = remove_decimals(100 - $percentage_used);
$bytes_used = byte_converter($used);
$bytes_free = byte_converter($ds - $used);
?>


<br><br>

<div class="panel panel-primary">
    <div class="panel-heading">Software versions</div>
    <div class="panel-body">
        <br>
        <?php 
        if($official_Scorpion_version != $local_Scorpion_version) { ?>
            <div class="alert alert-danger fontsize30 tt">
                <span class="tooltiptext"><b>Warning</b><br>Scorpion CMS is outdated!<br>
                    New version available: <b>v<?php echo $official_Scorpion_version; ?></b></span>
        <?php }
        else { ?>
            <div class="alert alert-success fontsize30">
        <?php } ?>
                <div class="pull-left">Scorpion CMS</div>
                <div class="pull-right">v<?php echo $local_Scorpion_version; ?></div>
                <div class="clearfix"></div>
            </div>

        <div class="alert alert-success fontsize30">
            <div class="pull-left">PHP</div>
            <div class="pull-right"><?php echo 'v'.  phpversion(); ?></div>
            <div class="clearfix"></div>
        </div>
        
    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">Disk status</div>
    <div class="panel-body">
        <br>
        <?php
        if($percentage_free < 20) { ?>
        <div class="alert alert-danger fontsize30 tt">
            <span class="tooltiptext"><b>Warning</b><br>It's recommended to have atleast 20% free disk space.</span>
        <?php }
        else { ?>
        <div class="alert alert-success fontsize30">
        <?php } ?>
            <div class="pull-left">Total disk space</div>
            <div class="pull-right"><?php echo byte_converter($ds); ?></div>
            <div class="clearfix"></div>
            
            <div class="pull-left">Used</div>
            <div class="pull-right"><?php echo $bytes_used.' ('.$percentage_used.'%)'; ?></div>
            <div class="clearfix"></div>
            
            <div class="pull-left">Free</div>
            <div class="pull-right"><?php echo $bytes_free.' ('.$percentage_free.'%)'; ?></div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">TODO : System information</div>
    <div class="panel-body">
        <br>
        <ul class="list-group">
            <li class="list-group-item list-group-item-danger">&cross; Various logs</li>
            <li class="list-group-item list-group-item-success">&check; Disk space</li>
            <li class="list-group-item list-group-item-warning">? Disk health status / S.M.A.R.T</li>
            <li class="list-group-item list-group-item-danger">&cross; Health (scheduled check for corrupt Scorpion files etc)</li>
            <li class="list-group-item list-group-item-success">&check; PHP version</li>
            <li class="list-group-item list-group-item-success">&check; Scorpion CMS version</li>
            <li class="list-group-item list-group-item-danger">&cross; Webserver (Apache etc) version</li>
            <li class="list-group-item list-group-item-info">++</li>
        </ul>
        
    </div>
</div>


