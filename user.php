<?php
require 'database.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    die();
}

$email = $_SESSION['user'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM user where email = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <link type="text/css" href="css/css_user.css" rel="stylesheet">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">

    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>
<div align="left"> <img src="/img/image7.png" usemap="#image-map">

    <map name="image-map">
        <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
    </map>
    <?php

    if (!isset($_SESSION['user']))
        echo '
<div id="coco">
                <a  class="btn btn-default" href="signin.php">Sign in </a>
                <a class="btn btn-default" href="create.php">Sign up</a> </div>
            ';
    else echo '<div id="coco2">
                <a class="btn btn-default" href="signout.php">Sign out </a>
        </div>    ';
    ?>
</div>

<div id="menu">

    <ul id="nav">
        <li>
            <a href="home_page.php" title="Вернуться на главную страницу">Home</a>
        </li>
        <li>
            <a href="news.php" title="Новости приюта"> News shelter  </a>
        </li>
        <li>
            <a href="list_pets.php" title="List pets">Pets</a>
            <ul>
                <li><a href="list_pets.php?type=cats">Cats</a></li>
                <li> <a href="list_pets.php?type=dogs">Dogs</a></li>
                <li><a href="list_pets.php?type=other">Other</a></li>
            </ul>
        </li>
        <li class="nav-item active">
                <a class="nav-link" href="message_for_user.php">Message<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="user.php" >My page <span class="sr-only">(current)</span></a>
            </li>
    </ul>
</div>
</div>
<br>
<div id="container_for_user_1">

    <div id="container_for_user_2">
        <div class="row">
            <h3>Read a User</h3>
        </div>

        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['name']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email Address</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['email']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['password']; ?>
                    </label>
                </div>
            </div>

            <div>
                <?php echo '<a class="btn btn-danger" href="delete.php?id=' . $data['id'] . '">Delete</a>'; ?>
               <?php echo '<a class="btn btn-success" href="update_for_user.php?id=' . $data['id'] . '">Update</a>';?>


            </div>

        </div>
    </div>

</div>
</body>
</html>