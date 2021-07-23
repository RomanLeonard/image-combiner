<?php

    $file = basename($_GET['file']);
    $file = 'combined/'.$file;

    if(!file_exists($file)){
        header("Location: error.php?error=file-not-found");
        die();
    } else {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        readfile($file);
    }

?>