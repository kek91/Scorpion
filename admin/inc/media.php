<h1>Media</h1>

<div class="panel panel-primary">
    <div class="panel-heading">Server file browser</div>
    <div class="panel-body">
        <form action="media" method="post" id="media-form">
        <table class="table table-striped table-hover" id="datatable">
            <thead>
                <tr>
                    <th><input type="checkbox" name="files[]" value="All"></th>
                    <th>Filetype</th>
                    <th>Filename</th>
                    <th>Size MB</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $directory = new RecursiveDirectoryIterator(SCORPION_DIR_MEDIA);
                $mega = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST);
                foreach ($mega as $name => $file) {
                    if(!$file->isDir()) {
                        $fileExt = strtolower($file->getExtension());
                        $fileName = $file->getBasename();
                        $fileDate = date("d-m-Y H:i:s", $file->getMTime());
                        $fileSize = number_format(($file->getSize() / 1024 / 1024), 2, '.', '');
                        /*$fileSize = number_format(($file->getSize() / 1024), 0, '', '');
                        if($fileSize > 999) {
                            $fileSize = number_format(($fileSize / 1024), 0, '', '');
                            $fileSize .= " MB";
                        }
                        else {
                            $fileSize .= " KB";
                        }
                        */
                        
                        if($fileExt == "jpg" ||
                                $fileExt == "jpeg" || 
                                $fileExt == "bmp" ||
                                $fileExt == "gif" || 
                                $fileExt == "png" ||
                                $fileExt == "tiff"
                        ) {
                            $fileType = "Image";
                            $fileIcon = "icon-images-gallery.png";
                        }
                        elseif($fileExt == "pdf" || 
                                $fileExt == "doc" || 
                                $fileExt == "docx" || 
                                $fileExt == "txt" || 
                                $fileExt == "rtf" || 
                                $fileExt == "md"
                        ) {
                            $fileType = "Document";
                            $fileIcon = "icon-document.png";
                        }
                        elseif($fileExt == "mp4" || 
                                $fileExt == "wmv" || 
                                $fileExt == "avi" || 
                                $fileExt == "mpeg" || 
                                $fileExt == "mpg" || 
                                $fileExt == "flv"
                        ) {
                            $fileType = "Video";
                            $fileIcon = "icon-video.png";
                        }
                        elseif($fileExt == "zip" || 
                                $fileExt == "rar" || 
                                $fileExt == "7zip" || 
                                $fileExt == "gz" || 
                                $fileExt == "tar"
                        ) {
                            $fileType = "Archive";
                            $fileIcon = "icon-archive.png";
                        }
                        else {
                            $fileType = '.'.$fileExt;
                            $fileIcon = "icon-question-sign.png";
                        }

                        echo '<tr onclick="selectRow(this);">'; /*  onclick="location.href=\''.SCORPION_URL.'/media/'.$fileName.'\';" */ 
//                        echo '<td>'.$fileType.'</td>';
                        echo '<td><input type="checkbox" name="files[]" value="'.$fileName.'"></td>';
                        echo '<td><img src="themes/default/icons/'.$fileIcon.'" alt="'.$fileType.'" title="'.$fileType.'"></td>';
//                        echo '<td>'.$fileDate.'</td>';
                        echo '<td>'.$fileName.'</td>';
                        echo '<td>'.$fileSize.'</td>';
                        if($fileType == "Image") {
                            echo '<td><a href="'.SCORPION_URL.'/media/'.$fileName.'"><img src="'.SCORPION_URL.'/media/'.$fileName.'" alt="'.$fileType.'" title="'.$fileType.'"></a></td>';
                        }
                        else {
                            echo '<td><a href="'.SCORPION_URL.'/media/'.$fileName.'"><img src="themes/default/icons/icon-download-alt.png" alt="Download" title="Download"></a></td>';
                        }
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="col-md-4">
            <select class="form-control">
                <option>- Choose action -</option>
                <option>Delete</option>
                <!--<option>Archive</option>-->
            </select>
        </div>
            
        <div class="col-md-8">
            <input type="submit" class="btn btn-danger" value="Do it">
        </div>

        </form>
    </div>
</div>



<div class="panel panel-primary">
    <div class="panel-heading">Upload files</div>
    <div class="panel-body">
        <h4>Work in progress</h4>
        <form action="#" method="post" id="media-form">
        </form>
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
    
    
    document.querySelector('input[type=checkbox]').addEventListener("click", function(e) {
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach(function(e) {
            e.checked = !e.checked;
        });
    });

    
});

function selectRow(row) {
    var firstInput = row.getElementsByTagName('input')[0];
    firstInput.checked = !firstInput.checked;
}
</script>