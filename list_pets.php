<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 29.10.18
 * Time: 21:05
 */

include 'database.php';
session_start();
$type = null;
if ( !empty($_GET['type'])) {
    $type= $_REQUEST['type'];
}

$pdo = Database::connect();
$edit_message = false;
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
if ( null==$type ) {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from pets ORDER BY idpets DESC";
    $data =$pdo->query($sql);
    Database::disconnect();
}
else {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from pets where type = ? ORDER BY idpets DESC";
    $pets = $pdo->prepare($sql);
    $pets->execute(array($type));
    $data = $pets->fetchAll();
    Database::disconnect();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <title>mysite.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link type="text/css" href="css/css_list_pets.css" rel="stylesheet">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">


</head>

<body>

<body>
<?php if(!$edit_message)
{echo '
<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>';}?>
<div >

    <div align="left"> <a <?php echo ($edit_message) ? 'href="pagemoderator.php"' : 'href="home_page.php"';?>> <img src="/img/image7.png"></a>

         </div>
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
 <?php if(!$edit_message) {
   echo ' <map name="image-map">
        <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
    </map>
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
            </li> ';
 }

            if (isset($_SESSION['user']) && !$edit_message) {
                echo '<li class="nav-item active">
                <a class="nav-link" href="home_page.php">Message<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="user.php" >My page <span class="sr-only">(current)</span></a>
            </li>';
            }

            ?>
        </ul>
    </div>
</div>
<br><br><br>
<div class="container">
    <?php if (count($data)== 0) echo '<h2>is Empty</h2>'; ?>
   <div id="container_2">

       <?php

       foreach ($data as $row) {

               echo '<div id="c1">';
               if ($edit_message) {
                   echo '<p align="right"><a title="Delete pet" href="delete_pets.php?idpets='.$row['idpets'].'">
                      <img  src="img/delete.jpeg" style="height: 20px; width: 20px;"></a></p>';

               }

               echo '  <div id="c1.1">';
               echo '   <a href="page_pets.php?idpets='.$row['idpets'].'">  <img  src="' . $row['photo'] .
                   '" style="height: 150px; width: 150px;"></a>';
               echo ' </div>';
               echo '  <div id="c1.2">';
               echo ' <a href="page_pets.php?idpets='.$row['idpets'].'">'.$row['nickname'].'</a>';

               echo '  </div>';
               echo ' <br>  </div>';

       }
        ?>
    </div>
</div>

</body>
</html>