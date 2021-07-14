<?php 

    // UPLOAD WATERMARK (JUST 1)
    if(isset($_POST['submitWatermark'])){
        if(isset($_FILES['watermark'])){
            $fileName = $_FILES['watermark']['name'];
            $fileTmpName = $_FILES['watermark']['tmp_name'];
            $fileSize = $_FILES['watermark']['size'];
            $fileError = $_FILES['watermark']['error'];
            $fileType = $_FILES['watermark']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 50000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt = strtolower(end($fileExt));;
                        $fileDestination = "watermark/$fileNameNew";
                        move_uploaded_file($fileTmpName, $fileDestination);
                        header("Location: index.php?watermarkSuccess");
                    } else { echo "This file is too big"; }
                } else{ echo 'Error uploading file'; }
            }   else { echo 'This type of files are not allowed'; }
        }
    }

    // UPLOAD IMAGES
    if(isset($_POST['submitBg'])){
        
        if(isset($_FILES['file'])){

            $count = count($_FILES['file']['name']);

            for($i=0; $i<$count; $i++){
                $fileName = $_FILES['file']['name'][$i];
                $fileTmpName = $_FILES['file']['tmp_name'][$i];
                $fileSize = $_FILES['file']['size'][$i];
                $fileError = $_FILES['file']['error'][$i];
                $fileType = $_FILES['file']['type'][$i];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');

                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize < 50000000){
                            $fileNameNew = uniqid('', true).".".$fileActualExt = strtolower(end($fileExt));;
                            $fileDestination = "uploads/$fileNameNew";
                            move_uploaded_file($fileTmpName, $fileDestination);
                            header("Location: index.php?success=$count");
                        } else { echo "This file is too big"; }
                    } else{ echo 'Error uploading file'; }
                }   else { echo 'This type of files are not allowed'; }

            }
        }

    }
?>