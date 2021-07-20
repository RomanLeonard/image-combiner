<?php 
    // READ FILES IN `UPLOADS`
    $upload_dir = './uploads';
    $uploaded_images = null;
    $image_name = [];
    foreach (scandir($upload_dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $uploaded_images += 1;
            $image_name[] = './uploads/'.$file;
        }
    }

    // READ FILE IN WATERMARK DIRECTORY
    $watermark_dir = './watermark';
    $current_watermark = '';
    $uploaded_watermark = null;
    foreach (scandir($watermark_dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $uploaded_watermark += 1;
            if ($uploaded_watermark === 1){
            $current_watermark = './watermark/'.$file;
            } else {}
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./assets/favicon.png"/>
    <link rel="stylesheet" href="./style/master.css">
    <title>IMAGE COMBINER - Add watermark/logo to images</title>
</head>
<body>
    
    
    <h1 class="title">IMAGE COMBINER</h1>

    <?php 

        if(isset($_GET['combinedSuccessfully'])){
            echo '<div class="success">
                <p>Combined successfully.</p>
            </div> ';
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
                                    echo "<img id='watermark-preview' src='$current_watermark' />";
                                } else {
                                    echo "Select watermark/logo";
                                }
                            ?>       

                        </label>
                        <input type="file" name="watermark" multiple id="watermark-input" onchange="readURL(this);"/>
                        <button type="submit" name="submitWatermark">UPLOAD</button>
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
                                    echo "Select images";
                                }
                            ?>
                        </label>
                        <input type="file" name="file[]" multiple id="background-input"/>
                        <button type="submit" name="submitBg">UPLOAD</button>
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

    <div class="info">
        <div class="card">
            <div class="card-content">
                <p>This is an open source application that you can clone from <a href="" target="_blank" rel="noopener noreferrer"></a> GitHub</p>
                <p>Developed by Leonard Roman</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#watermark-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>