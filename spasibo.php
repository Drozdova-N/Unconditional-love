<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 29.10.18
 * Time: 21:07
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <script src="js/bootstrap.min.js"></script>
    <link type="text/css" href="css/css6.css" rel="stylesheet">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">

</head>

<body>
<div >

    <div align="left"> <img src="/img/image7.png" usemap="#image-map">

        <map name="image-map">
            <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
        </map>
        <?php
        session_start();
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
            <?php
            //session_start();
            if (isset($_SESSION['user'])) {
                echo '<li class="nav-item active">
                <a class="nav-link" href="message_for_user.php">Message<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="user.php" >My page <span class="sr-only">(current)</span></a>
            </li>';
            }

            ?>
        </ul>
    </div>
</div>
<br>
<center><h1>Спасибо, что оставили заявку, ее рассмотрят в течение суток</h1>
<img src="/img/spasibo.png"></center>
</body>

</html>