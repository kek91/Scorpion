<?php
include_once("../../core/init.php");

$user = new User();
if(!$user->isLoggedIn()) {
    $_SESSION['error'] = 'You must be logged in to access this page.';
    Redirect::to('login');
    exit();
}
else {
    
    class RecursiveFilterIteratorScorpion extends RecursiveFilterIterator
    {
        public function accept()
        {
            $excludes = array("backup", ".git");
            return !($this->isDir() && in_array($this->getFilename(), $excludes));
        }
    }
    
    
    $output = "";
    if(isset($_POST['backup'])) {
        $backuptypes = explode('-', escape($_POST['backup']));
        $zip_filename_date = date("d-m-Y-His");
        $zip = new ZipArchive();
        $zip->open(SCORPION_DIR_BACKUP.'Backup_'.$zip_filename_date.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        foreach($backuptypes as $type) {
            
            if($type == "Scorpion") {
                /* Backup SCORPION CMS files */
                $directory = new RecursiveDirectoryIterator(SCORPION_DIR_ROOT);
                $filtered = new RecursiveFilterIteratorScorpion($directory); 
                $mega = new RecursiveIteratorIterator($filtered, RecursiveIteratorIterator::SELF_FIRST);
                foreach ($mega as $name => $file)
                {
                    // Skip directories (they would be added automatically)
                    if(!$file->isDir())
                    {
                        // Get real and relative path for current file
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen(SCORPION_DIR_ROOT));
                        // Add current file to archive
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
            
            elseif($type == "Website") {
                /* Backup WEBSITE files */
                
            }
            
            elseif($type == "Content") {
                /* Backup CONTENT data ( /scorpion/content/*.* ) */
                $directory = new RecursiveDirectoryIterator(SCORPION_DIR_CONTENT);
                $mega = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST);
//                $filtered = new RecursiveFilterIteratorScorpion($directory); 
//                $mega = new RecursiveIteratorIterator($filtered, RecursiveIteratorIterator::SELF_FIRST);
                foreach ($mega as $name => $file)
                {
                    // Skip directories (they would be added automatically)
                    if(!$file->isDir())
                    {
                        // Get real and relative path for current file
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen(SCORPION_DIR_ROOT));
                        // Add current file to archive
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
            
        }
        
        $zip->close();
        $output .= '<div class="alert alert-success">Backup complete!</div>';
        $output .= 'Click on the link below to download a copy of the zipped archive:<br>';
        $output .= '<a href="'.SCORPION_URL.'/backup/Backup_'.$zip_filename_date.'.zip">'.SCORPION_URL.'/backup/Backup_'.$zip_filename_date.'.zip</a></div>';
        exit($output);
    }
    else {
        $output .= "Hello world. Good bye world.";
        exit($output);
    }
}