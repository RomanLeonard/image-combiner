<?php

    // DELETE FILES IN combined DIR
    if(isset($_POST['combined'])){
        $files = glob('combined/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file);
            }
        }
        header('Location: ./index.php?deleted=combined');
    }
    // DELETE FILES IN watermark DIR
    if(isset($_POST['watermark'])){
        $files = glob('watermark/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file); 
            }
        }
        header('Location: ./index.php?deleted=watermark');
    }
    // DELETE FILES IN upload DIR
    if(isset($_POST['uploads'])){
        $files = glob('uploads/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file);
            }
        }
        header('Location: ./index.php?deleted=uploads');
    }
    // DELETE FILES IN all DIRETORIES
    if(isset($_POST['all'])){
        $files = glob('combined/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file);
            }
        }
        $files = glob('watermark/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file); 
            }
        }
        $files = glob('uploads/*');
        foreach($files as $file){ 
            if(is_file($file)) {
                unlink($file); 
            }
        }
        header('Location: ./index.php?deleted=all');
    }

?>