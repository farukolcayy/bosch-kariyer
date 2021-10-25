<?php
/*
 * PHP Recursive Backup-Script to ZIP-File
 * (c) 2012: Marvin Menzerath. (http://menzerath.eu)
*/

// Make sure the script can handle large folders/files
ini_set('max_execution_time', 600);
ini_set('memory_limit', '1024M');

// Start the backup!
zipData('/home/bosch/yazilim-gelistirme-muhendisi/uploads', 'uploads/allCV.zip');

// Here the magic happens :)
function zipData($folder, $zipTo)
{
    array_map( 'unlink', array_filter((array) glob("/home/bosch/yazilim-gelistirme-muhendisi/ilan-basvuru-listesi/uploads") ) );

    if (extension_loaded('zip') === true) {
        if (file_exists($folder) === true) {
            $zip = new ZipArchive();

            if ($zip->open($zipTo, ZIPARCHIVE::CREATE) === true) {
                $source = realpath($folder);

                if (is_dir($source) === true) {
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

                    foreach ($files as $file) {
                        $file = realpath($file);

                        if (is_dir($file) === true) {
                            //$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                        } else if (is_file($file) === true) {
                            $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                        }
                    }
                } else if (is_file($source) === true) {
                    $zip->addFromString(basename($source), file_get_contents($source));
                }
            }
            return $zip->close();
        }
    }
    return false;
}
