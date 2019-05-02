<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 05.11.18
 * Time: 14:21
 */

session_start();
include "database.php";
$iduser_session = $_SESSION['iduser'];
if (!isset($_SESSION['user'])) {
    Database::disconnect();
    header("Location: signin.php");
    die();

}
   $pdo = Database::connect();
   $sql = 'SELECT * FROM application_from  ORDER BY id DESC';
   $rows = $pdo->query($sql);
   Database::disconnect();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <link type="text/css" href="css/css_for_news.css" rel="stylesheet">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>


<body>
<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>
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
</div> <br>
<?php
if ($rows->rowCount() > 0) {

    echo '<tbody>';
    $no_message = true;
    echo '<br>
<div id="container_for_news_1">';
    echo '<h3>Message </h3>';
    foreach ($rows as $row) {
        if ($row['iduser'] == $iduser_session) {
            $no_message = false;

            echo '<div id = "container_for_news_2">
        <br><td>' . $row['nickname'] . '<br><img src="' . $row['photo'] . '" style="height: 30px; width: 30px;">';
            if ($row['state'] == 1) {
                echo '<br>Ваша заявка принята, ' . $row['nickname'] . ' будет ждать вас с 09.00 до 22.00 по адресу at 247 k2 Institutsky Avenue';

            } elseif ($row['state'] == -1) {
                echo '<br>Ваша заявка отклонена , приносим извинения :(';

            } else echo '<br>Ваша заявка в рассмотрении!';
            echo '</div>';

        }

    }
    if ($no_message) echo 'Сообщений нет';
echo '</div>';
}


        ?>
</body>

</html>
