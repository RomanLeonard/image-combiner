<?php 

    // READ FILES IN `UPLOADS`
    $dirUpload = './uploads';
    $uploadFiles = array();
    $filesName = array();

    foreach (scandir($dirUpload) as $file) {
        if ($file !== '.' && $file !== '..') {
            $uploadFiles[] = $file;
        }
    }

    $filesCount = count($uploadFiles);
    for($i=0; $i<$filesCount; $i++){
        $filesName[] = $uploadFiles[$i];
    }
    /* $filesName is the array that contains files name */

    // READ FILE IN WATERMARK DIRECTORY
    $dirWatermark = './watermark';
    $watermark = array();
    $watermarkName = array();

    foreach (scandir($dirWatermark) as $file) {
        if ($file !== '.' && $file !== '..') {
            $watermark[] = $file;
        }
    }
    $filesCountWatermark = count($watermark);
    for($i=0; $i<$filesCountWatermark; $i++){
        $watermarkName[] = $watermark[$i];
    }


    // COMBINE FILES AND SAVE THEM IN NEW DIRECOTRY

    if(isset($_POST['combineBtn'])){

        $countFilesInUpload = count($filesName);

        // get width and height of the watermark;
        $watermarkImg = './watermark/'.$watermarkName[0];
        $watermarkSize = getimagesize($watermarkImg);
        $wtmWidth = $watermarkSize[0];
        $wtmHeight = $watermarkSize[1];

        for($i=0;$i<$countFilesInUpload;$i++){

            // get width and height of the background;
            $bgFile = './uploads/'.$filesName[$i];
            $bgFileSize = getimagesize($bgFile);
            $bgWidth = $bgFileSize[0];
            $bgHeight = $bgFileSize[1];

            

            ////////////////////////////////////////////
            // CHECK IF THE UPLOADED IMAGE IS A PNG, JPG or JPEG
            $currentBgExt = explode('.', $filesName[$i]);
            $currentBgExtLower = strtolower($currentBgExt[2]);
            
            if($currentBgExtLower === 'png'){
                $bgToBeInserted = imagecreatefrompng($bgFile);
            } elseif ($currentBgExtLower === 'jpg'){
                $bgToBeInserted = imagecreatefromjpeg($bgFile);
            } elseif ($currentBgExtLower === 'jpeg'){
                $bgToBeInserted = imagecreatefromjpeg($bgFile);
            } else { echo "This type of file is not allowed"; }


            
            
            $watermarkToBeInserted = imagecreatefrompng($watermarkImg);

            // make the watermark 50% of the bg size
            $halfWidth = $bgWidth/2;
            $halfHeight = $bgHeight/2;
            $final_watermark = imagecreatetruecolor($halfWidth, $halfHeight);
            imagealphablending($final_watermark, true);
            imagesavealpha($final_watermark, true);


            // find the center of the logo/watermark;
            $center_logo_x = ($bgWidth/2)-$halfWidth/2;
            $center_logo_y = ($bgHeight/2)-$halfHeight/2;

            $heightZero = -1;
            $watermarkResized = imagescale($watermarkToBeInserted, $halfWidth, $heightZero);
            imagepng($watermarkResized, './watermark/watermark-resized.png');
            $watermark_new_size = getimagesize('./watermark/watermark-resized.png');
            $watermark_width = $watermark_new_size[0];
            $watermark_height = $watermark_new_size[1];

            
            
            // dimensions of the final image 
            $final_img = imagecreatetruecolor($bgWidth, $bgHeight);
            imagealphablending($final_img, true);
            imagesavealpha($final_img, true);

            imagecopy($final_img, $bgToBeInserted, 0, 0, 0, 0, $bgWidth, $bgHeight);
            imagecopy($final_img, $watermarkResized, $center_logo_x, $center_logo_y, 0, 0, $watermark_width, $watermark_height);

            imagepng($final_img, "combined/image_$i.png");
            
            header("Location: index.php?combinedSuccessfully");
        }
    }

?>