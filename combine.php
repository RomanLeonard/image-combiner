<?php 

    // READ FILES IN uploads DIR
    $upload_dir = './uploads';
    $upload_files = array();
    foreach (scandir($upload_dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $upload_files[] = $file;
        }
    }

    // READ FILES IN watermark DIR
    $watermark_dir = './watermark';
    $watermark_file = array();
    foreach (scandir($watermark_dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $watermark_file[] = $file;
        }
    }
    

    if(isset($_POST['combineBtn']) && !empty($upload_files) && !empty($watermark_file)){
        $error = 0;

        $upload_files_count = count($upload_files);
        $watermark_img = './watermark/'.$watermark_file[0];
      
        for($i=0;$i<$upload_files_count;$i++){

            // GET THE width AND height OF THE BACKGROUND
            $bg_file = './uploads/'.$upload_files[$i];
            $bg_file_size = getimagesize($bg_file);


            // CHECK IF THE UPLOADED IMAGE IS A png, jpg OR jpeg
            $bg_ext = explode('.', $upload_files[$i]);
            $bg_ext_lower = strtolower($bg_ext[2]);

            if($bg_ext_lower === 'png'){
                $bg_to_insert = imagecreatefrompng($bg_file);
            } elseif ($bg_ext_lower === 'jpg'){
                $bg_to_insert = imagecreatefromjpeg($bg_file);
            } elseif ($bg_ext_lower === 'jpeg'){
                $bg_to_insert = imagecreatefromjpeg($bg_file);
            } else { 
                $error = 1;
            }
            
            $watermark_to_insert = imagecreatefrompng($watermark_img);

            // make the watermark 50% of the bg size
            $half_width = $bg_file_size[0]/2;
            $half_height = $bg_file_size[1]/2;
            $final_watermark = imagecreatetruecolor($half_width, $half_height);
            imagealphablending($final_watermark, true);
            imagesavealpha($final_watermark, true);

            // find the center of the logo/watermark;
            $center_logo_x = ($bg_file_size[0]/2)-$half_width/2;
            $center_logo_y = ($bg_file_size[1]/2)-$half_height/2;

            // RESIZE WATERMARK
            $watermark_resized = imagescale($watermark_to_insert, $half_width, -1);
            imagepng($watermark_resized, './watermark/watermark-resized.png');
            $watermark_new_size = getimagesize('./watermark/watermark-resized.png');
            $watermark_width = $watermark_new_size[0];
            $watermark_height = $watermark_new_size[1];

            
            // final image / merge
            $final_img = imagecreatetruecolor($bg_file_size[0], $bg_file_size[1]);
            imagealphablending($final_img, true);
            imagesavealpha($final_img, true);

            imagecopy($final_img, $bg_to_insert, 0, 0, 0, 0, $bg_file_size[0], $bg_file_size[1]);
            imagecopy($final_img, $watermark_resized, $center_logo_x, $center_logo_y, 0, 0, $watermark_width, $watermark_height);

            imagepng($final_img, "combined/image_$i.png");

        }
        if($error === 0){
            header("Location: index.php?combinedSuccessfully");
        }
        else { 
            header("Location: error.php?error=combined");
        }
    } 
    else{
        if(empty($watermark_file) && !empty($upload_files)){
            header("Location: error.php?error=combined-no-watermark");
        } elseif(!empty($watermark_file) && empty($upload_files)){
            header("Location: error.php?error=combined-no-images-uploaded");
        } elseif(empty($watermark_file) && empty($upload_files)){
            header("Location: error.php?error=combined-no-files-uploaded");
        }
    }

?>