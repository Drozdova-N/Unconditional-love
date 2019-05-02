<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 28.10.18
 * Time: 16:01
 */

include 'database.php';
session_start();

$pdo=Database::connect();
$edit_message=false;
if (isset($_SESSION['role'])) {
    $sql_role = 'SELECT * FROM role where id = ?';
    $q = $pdo->prepare($sql_role);
    $q->execute(array($_SESSION['role']));
    $access = $q->fetch(PDO::FETCH_ASSOC);
    $edit_message = false;
    if ($access['edit_message']) {
        $edit_message = true;
    }
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="Select * from news";
$rows = $pdo->query($sql); ///

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <link type="text/css" href="css/css_for_news.css" rel="stylesheet">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php if(!$edit_message)
    {echo '
<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>';}?>
<div>

    <div align="left"> <a <?php echo ($edit_message) ? 'href="pagemoderator.php"' : 'href="home_page.php"';?>> <img src="/img/image7.png"></a>

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

    echo '</div>';
if(!$edit_message) {
   echo '<div id="menu">

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
            </li>';}

            //session_start();
            if (isset($_SESSION['user']) && !$edit_message) {
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
<br>
<?php
if ($rows->rowCount() > 0) {
    echo '<div id="container_for_news_1">';
    echo '<h3>News shelter </h3>';
    foreach ($rows as $row) {
                  echo ' <div id="container_for_news_2">';
                  if($edit_message){
            echo '<p align="right"><a title="Delete pet" href="delete_news.php?idnews='.$row['idnews'].' "><img  src="img/delete.jpeg" style="height: 20px; width: 20px;"></a></p>';
        }
        echo  '<h3> ' . $row['headline'] . '</h3>';
        echo  '<h4> ' . $row['text'] . '</h4>';
        echo '<img src="' . $row['image'] . '">';
        echo '</div>';

    }
    echo '</div>';

} else  echo '<h3>Is Empty</h3><img width="65%"  src="img/cit.jpg">';

?>


</body>
</html>
