<?php 


// READ FILES IN uploads DIR
$upload_dir = './uploads';
$upload_files = array();
foreach (scandir($upload_dir) as $file) {
    if ($file !== '.' && $file !== '..') {
        $upload_files[] = $file;
    }
}

echo "upload: ";

if(empty($upload_files)){
    echo "mmo";
}
else {
    echo "je";
}

echo "<br><br><br>";


// READ FILES IN watermark DIR
$watermark_dir = './watermark';
$watermark_file = array();
foreach (scandir($watermark_dir) as $file) {
    if ($file !== '.' && $file !== '..') {
        $watermark_file[] = $file;
    }
}

echo "watermark: ";
print_r($watermark_file);

echo "<br><br><br>";

?>