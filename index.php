<?php 

    // READ FILES IN upload DIRECTORY
    $upload_dir = './uploads';
    $uploaded_images = null;
    $image_name = [];
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    } else{
        foreach (scandir($upload_dir) as $file) {
            if ($file !== '.' && $file !== '..') {
                $uploaded_images += 1;
                $image_name[] = './uploads/'.$file;
            } 
        } 
    }

    // READ FILE IN watermark DIRECTORY
    $watermark_dir = './watermark';
    $current_watermark = '';
    $uploaded_watermark = null;
    if (!file_exists($watermark_dir)) {
        mkdir($watermark_dir, 0777, true);
    } else{
        foreach (scandir($watermark_dir) as $file) {
            if ($file !== '.' && $file !== '..') {
                $uploaded_watermark += 1;
                if ($uploaded_watermark === 1){
                $current_watermark = './watermark/'.$file;
                } 
            } 
        }
    }

    // READ FILE IN combined DIRECTORY
    $combined_dir = './combined';
    $combined_index = 0;
    if (!file_exists($combined_dir)) {
        mkdir($combined_dir, 0777, true);
    } else{
        foreach (scandir($combined_dir) as $file) {
            if ($file !== '.' && $file !== '..') {
                $combined_index++;
            } 
        }
    }

    include 'header.php';
?>

    <div class="title">
        <img src="assets/image-combiner.png" alt="IMAGE-COMBINER LOGO - Add watermark on photos in bulk for free.">
    </div>

<?php 

    if(isset($_GET['combinedSuccessfully'])){
        echo '<div class="info-card success">
            <p>Combined successfully.</p>
        </div> ';
    } 

    if(isset($_GET['deleted'])){
        switch($_GET['deleted']){
            case 'combined':
                echo "<div class='info-card delete'>
                    <p>Combined items deleted successfully.</p>
                </div> ";
                break;
            case 'uploads':
                echo '<div class="info-card delete">
                    <p>Uploaded items deleted successfully.</p>
                </div> ';
                break;
            case 'watermark':
                echo '<div class="info-card delete">
                    <p>Watermark/logo deleted successfully.</p>
                </div> ';
                break;
            case 'all':
                echo '<div class="info-card delete">
                    <p>All images deleted successfully.</p>
                </div> ';
                break;
        }
    }

?>

    <div class="container">
        <div class="row">
            <div class="watermark">
                <div class="wrapper">
                    <span>WATERMARK</span>
                    <form class="wrapper-form" action="upload.php" method="POST" enctype="multipart/form-data">
                        <label for="watermark-input">
                            
                            <?php 
                                if(!is_null($uploaded_watermark)){
                                    echo "<img id='watermark-preview' src='$current_watermark' class='watermark-preview'/>";
                                } else {
                                    echo "Select watermark/logo (only PNG)";
                                }
                            ?>       

                        </label>
                        <input type="file" name="watermark" multiple id="watermark-input" onchange="readURL(this);"/>
                        <button type="submit" name="submitWatermark">VERIFY UPLOAD</button>
                    </form>
                </div>
            </div>
            <div class="background-images">
                <div class="wrapper">
                    <span>BACKGROUND IMAGES</span>
                    <form class="wrapper-form" action="upload.php" method="POST" enctype="multipart/form-data">
                        <label for="background-input">
                            <?php 
                                 if(!is_null($uploaded_images)){
                                    echo "<div class='images-preview'>";
                                        for($i=0;$i<$uploaded_images;$i++){
                                            echo "<img class='preview' src='$image_name[$i]'>";
                                        }
                                    echo "</div>";
                                } else {
                                    echo "Select images (only PNG, JPG or JPEG)";
                                }
                            ?>
                        </label>
                        <input type="file" name="file[]" multiple id="background-input"/>
                        <button type="submit" name="submitBg">VERIFY UPLOAD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="combine-btn">
        <form action="combine.php" method="POST">
            <button type="submit" name="combineBtn">COMBINE</button>
        </form>
    </div>

<!-- download button -->
<?php

    if($combined_index >= 1 || $uploaded_images >= 1 || $uploaded_watermark >= 1){
        if ($combined_index >=1 && $handle = opendir('combined/')) {
            echo "<div class='download'><span>DOWNLOAD</span><div class='wrapper'>";
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $combined_index++;
                    echo "<a class='download-btn' href='download.php?file=".$entry."'>".$entry."</a>";
                }
            }
            closedir($handle);
            echo "</div></div>";
        }


        echo "<div class='delete-section'>
            <span>DELETE</span>
            <form action='delete.php' method='POST'>";
            
            if($combined_index >= 1) echo "<button type='submit' name='combined'>COMBINED FILES</button>";
            if($uploaded_images >= 1) echo "<button type='submit' name='uploads'>UPLOADED IMAGES</button>";
            if($uploaded_watermark >= 1) echo "<button type='submit' name='watermark'>UPLOADED WATERMARK/LOGO</button>";
            if($combined_index >= 1 && $uploaded_images >= 1 && $uploaded_watermark >= 1) echo "<button type='submit' name='all'>ALL</button>";
            
        echo "</form></div>";
    }

    include 'footer.php';
?>