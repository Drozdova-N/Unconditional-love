
<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//echo '<pre>';
//var_dump($check);
//echo '</pre>';
// Check if file already exists 1
if (file_exists($target_file)) {
    echo "Sorry, 1.";
    $uploadOk = 0;
}
// Check file size 2
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, 2.";
    $uploadOk = 0;
}
// Allow certain file formats 3
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, 3.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error 4
if ($uploadOk == 0) {
    echo "Sorry, 4.";
// if everything is ok, try to upload file 5
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        //echo '<pre>';
      //  var_dump($_FILES);
       // echo '</pre>';

       // echo '<pre>';
//        echo '</pre>';
    } else {
        echo "Sorry, 5.";
        //echo '<pre>';
     //   var_dump($_FILES);
      //  echo '</pre>';

     //   echo '<pre>';
      //  var_dump($target_file);
      //  echo '</pre>';
    }
}
?>
