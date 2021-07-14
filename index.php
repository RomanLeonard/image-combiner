

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/master.css">
    <title>IMAGE COMBINER</title>
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

    <!-- -->

    <div class="container">
        <div class="row">
            <div class="watermark">
                <div class="wrapper">
                    <span>WATERMARK</span>
                    <form class="wrapper-form" action="upload.php" method="POST" enctype="multipart/form-data">
                        <label for="watermark-input">
                            <?php 
                                if (isset($_GET['watermarkSuccess'])){ echo "Watermark/logo selected";} else { echo "Select watermark/logo";}
                            ?>       
                        </label>
                        <input type="file" name="watermark" multiple id="watermark-input"/>
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
                                if(isset($_GET['success'])){
                                    echo "Images uploaded: ".$_GET['success'];
                                } else { echo "Select images"; }
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

    



    <!-- WATERMARK UPLOAD
    <h1>WATERMARK</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="watermark">Browse file...</label>
        <input type="file" name="watermark" multiple id="watermark"/>
        <button type="submit" name="submitWatermark">UPLOAD</button>
    </form> -->
    <!-- BACKGROUND UPLOAD
    <h1>BACKGROUND</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file[]" multiple/>
        <button type="submit" name="submitBg">UPLOAD</button>
    </form> -->


    








</body>
</html>