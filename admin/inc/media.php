<h1>Media</h1>

<div class="panel panel-primary">
    <div class="panel-heading">Server file browser</div>
    <div class="panel-body">
        <table class="table table-striped table-hover" id="datatable">
            <thead>
                <tr>
                    <th><input type="checkbox" name="files[]" value="All"></th>
                    <th>Filetype</th>
                    <th>Filename</th>
                    <th>Size MB</th>
                    <th>Preview</th>
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

                        echo '<tr>'; /*  onclick="location.href=\''.SCORPION_URL.'/media/'.$fileName.'\';" */ 
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
                            echo '<td></td>';
                        }
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
    
    
    document.querySelector('input[type=checkbox]').addEventListener("click", function(e) {
        console.log("clicked");
        
        [].forEach.call(document.querySelectorAll('input[type=checkbox]'), function(e) {
            var checkbox = document.querySelectorAll("input[type='checkbox']");
            if (checkbox) {
                // if it exists, toggle the checked property
                checkbox.checked = !checkbox.checked;
            }
        });
        
    });
    
    
} );



</script>