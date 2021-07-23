<?php 
    if(isset($_GET['error'])){
        
        include_once 'header.php';
        $error = $_GET['error'];

        switch($error){
            case 'upload-type':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. This type of file is not allowed. Please go back and upload only <b>PNG</b>, <b>JPG</b> or <b>JPEG</b> <a href='index.php'>go back</a></p></div></div>";
                break;
            case 'upload-corrupted':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. File may be corrupted, please upload another file. <a href='index.php'>go back</a></p></div></div>";
                break;
            case 'upload-size':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. File is too big. <a href='index.php'>go back</a></p></div></div>";
                break;
            case 'download-not-found':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. File not found. <a href='index.php'>go back</a></p></div></div>";
                break;


            case 'combined-no-watermark':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. Please select a watermark/logo. <a href='index.php'>go back</a></p></div></div>";
                break;
            case 'combined-no-images-uploaded':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. Please select at least 1 image. <a href='index.php'>go back</a></p></div></div>";
                break;
            case 'combined-no-files-uploaded':
                echo "<div class='error'><div class='info-card delete'><p>ERROR. No files were selected. <a href='index.php'>go back</a></p></div></div>";
                break;
            default:
                header("Location: index.php");
                exit;
        }
        include_once 'footer.php';
    }
    else{
        die();
        exit;
    }
?>