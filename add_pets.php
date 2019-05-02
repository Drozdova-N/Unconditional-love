<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 28.10.18
 * Time: 18:44
*/
require 'database.php';
if(!empty($_POST))
{
    // keep track validation errors
    $nicknameError = null;
    $date_of_birthError=null;
    $descriptionError= null;
    $pathError=null;
    $typeError= null;

    // keep track post values
    $nickname= $_POST['nickname'];
    $date_of_birth=$_POST['date_of_birth'];
    $description=$_POST['text'];
    $type= $_POST['type'];

    $valid= true;

    if(empty($nickname))
    {
        $nicknameError="Введите кличку";
        $valid=false;
    }

    if(empty($date_of_birth))
    {
        $date_of_birthError="Введите дату";
        $valid=false;
    }

    if(empty($description))
    {
        $descriptionError="Введите описание";
        $valid=false;
    }

    if(empty($type))
    {
        $typeError="Выбирете тип животного";
        $valid=false;
    }

// Загрузка фотографии в папку pets
    $target_dir = "pets/";
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
        $pathError = $pathError."Sorry, file already exists. ";
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
        $sql = "INSERT INTO pets (nickname , date_of_birth , description , photo ,type ) value (?,?,?,?,?)";
        $add = $pdo->prepare($sql);
        $add->execute(array($nickname, $date_of_birth, $description , $path , $type));
        Database::disconnect();
        header("Location: pagemoderator.php");




    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <title>mysite.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link type="text/css" href="css/css6.css" rel="stylesheet">
</head>
<body>
<div align="left"> <a href="pagemoderator.php"> <img src="/img/image7.png"></a>

<div id="container_for_about_1">
    <div id="container_for_about_2">
        <h2> Добавление животного</h2>
<form  action="add_pets.php" method="post" enctype="multipart/form-data">
    <input name="nickname" type="text"  placeholder="Nickname" required autofocus
           value="<?php echo !empty($nickname) ? $nickname : ''; ?>">
    <?php if (!empty($nicknameError)): ?>
        <span class="help-inline"><?php echo $nicknameError; ?></span>
    <?php endif; ?>
    <br><br>
    <input name="date_of_birth" type="date"  placeholder="Date of birth format " required autofocus
           value="<?php echo !empty($date_of_birth) ? $date_of_birth : ''; ?>">
    <?php if (!empty($date_of_birthError)): ?>
        <span class="help-inline"><?php echo $date_of_birthError; ?></span>
    <?php endif; ?>
    <br><br>


    <textarea name="text" rows=4 cols=40 >
         <?php echo !empty($description)?$description : ''; ?>
    </textarea>
    <select name="type" >

        <option selected disabled>Выберите вид животного</option>
        <option value="cats">Cats</option>
        <option value="dogs">Dogs</option>
        <option value="other">Other</option>

    </select>

    <br><br>

    <input type="file" name="fileToUpload" id="fileToUpload">
    <?php if (!empty($pathError)): ?><a><?php echo $pathError; ?></a><br>
    <?php endif; ?>
    <br>
    <input type="submit" value="Add pets" name="submit">
</form>
</div>
</div>
</body>
</html>

