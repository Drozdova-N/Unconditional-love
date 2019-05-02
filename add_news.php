<?php
require 'database.php';

if (!empty($_POST)) {
// keep track validation errors
    $headlineError = null;
    $textError = null;
    $pathError = null;

// keep track post values
    $headline = $_POST['headline'];
    $text = $_POST['text'];
//$path = $_POST['path'];


    $valid = true;
    if (empty($headline)) {
        $headlineError = "Введите заголовок";
        $valid = false;

    }
    if (empty($text)) {
        $textError = "Введите текст новости";
        $valid = false;
    }

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $pathError =$pathError."File is not an image. ";
            $uploadOk = 0;
        }
    }
// Check if file already exists 1
    if (file_exists($target_file)) {
        $pathError = "Sorry, file already exists. ";
        $uploadOk = 0;
    }

// Check file size 2
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $pathError = $pathError . "Sorry, file already exists. ";
        $uploadOk = 0;
    }

// Allow certain file formats 3
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $pathError = $pathError . "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error 4
    if ($uploadOk == 0) {

        $pathError = $pathError . "Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file 5
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $path = $target_file;

        } else {
            $pathError = $pathError . "Sorry, there was an error uploading your file. ";

        }
    }

    if (empty($path)) {
        $valid = false;
    }

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO news (headline , text , image) value (?,?,?)";
        $add = $pdo->prepare($sql);
        $add->execute(array($headline, $text, $path));
        Database::disconnect();
        header("Location: pagemoderator.php");

    }
}
?>


<!DOCTYPE html>
<html>
<head><link type="text/css" href="css/css6.css" rel="stylesheet"></head>
<body>
<div align="left"> <a href="pagemoderator.php"> <img src="/img/image7.png"></a>

</div>
<div id="container_for_about_1">
    <div id="container_for_about_2">
        <h2>Новости</h2>

<form  action="add_news.php" method="post" enctype="multipart/form-data">
    <input name="headline" type="text"  placeholder="Headline" required autofocus
           value="<?php echo !empty($headline) ? $headline : ''; ?>">
    <?php if (!empty($headlineError)): ?>
        <span class="help-inline"><?php echo $headlineError; ?></span>
    <?php endif; ?>
    <br><br>
    <textarea name="text" rows=4 cols=40>
        <?php echo !empty($text) ? $text : ''; ?></textarea>
<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <?php if (!empty($pathError)): ?><br><a><?php echo $pathError;?></a>
        <br>
    <?php endif; ?>
    <br><br>
    <input type="submit" value="Add news" name="submit">
</form>
    </div>
</div>
</body>
</html>