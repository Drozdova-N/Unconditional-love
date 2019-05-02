<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 29.10.18
 * Time: 21:06
 */
session_start();
include 'database.php';
$idpets = null;
if ( !empty($_GET['idpets'])) {
    $idpets= $_REQUEST['idpets'];
}
if ( null==$idpets ) {
    header("Location: index.php");}
else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from pets where  idpets= ?";
    $pets = $pdo->prepare($sql);
    $pets->execute(array($idpets));
    $data = $pets->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}


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
<div id="container_for_about_1">
    <div id="container_for_about_2">
<div class="controls">
    <label class="checkbox">
        <?php echo $data['nickname'];?>
    </label>

    <label class="control-label">Photo</label>
    <div class="controls">
        <label class="checkbox">
            <?php echo '<img src="' . $data['photo'] . '" style="height: 150px; width: 150px;">';?>
        </label>
</div>

<form action="message.php" method="post">
    <h1>Оставьте вашу заявку</h1>
    <input type="hidden" name="idpets" value="<?php echo ''.$data['idpets'].'';?>">
    <textarea name="message" rows=5 cols=50>
        <?php echo !empty($message) ? $message : ''; ?></textarea>
    <br>
    <input type="submit" value="Отправить" name="submit">

</form>
</div>
    </div>
</body>

</html>

