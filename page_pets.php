<?php

session_start();
include 'database.php'; //подключение бд
$pdo = Database::connect();
$edit_message = false;
if (!empty($_SESSION['role'])) {
    $sql_role = 'SELECT * FROM role where id = ?';
    $q = $pdo->prepare($sql_role);
    $q->execute(array($_SESSION['role']));
    $access = $q->fetch(PDO::FETCH_ASSOC);
    if ($access['edit_message']) {
        $edit_message = true;
    }
}
Database::disconnect();


$idpets = null;
if (!empty($_GET['idpets'])) {
    $idpets = $_REQUEST['idpets'];
}
if (null == $idpets) {
    header("Location: index.php");
} else {
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <link type="text/css" href="css/css_user.css" rel="stylesheet">
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

<body>
<?php if (!$edit_message) {
    echo '
<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>';
} ?>
<div>

    <div align="left"><a <?php echo ($edit_message) ? 'href="pagemoderator.php"' : 'href="home_page.php"'; ?>> <img
                    src="/img/image7.png"></a>

    </div>
    <?php
    //  session_start();
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

<map name="image-map">
    <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
</map>
<?php


if (!$edit_message) {
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

<div id="container_for_user_1">

    <div id='container_for_user_2'>
        <div class="row">
            <h3>Read a Pets</h3>
        </div>

        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Nickname:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['nickname']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Date:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['date_of_birth']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Description:</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['description']; ?>
                    </label>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Photo</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo '<img src="' . $data['photo'] . '" style="height: 250px; width: 250px0";>'; ?>
                    </label>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['user'])) {
                echo 'Зарегистрируйтесь или войдите чтобы оставить заявку<br>';
                echo ' <a  href="signin.php?idpets=' . $data['idpets'] . '">Sign in </a>';
                echo '<a  href="create.php?idpets=' . $data['idpets'] . '">Sign up</a>';

            } else {
                $pdo = Database::connect();
                $sql_role = 'SELECT * FROM role where id = ?';
                $q = $pdo->prepare($sql_role);
                $q->execute(array($_SESSION['role']));
                $access = $q->fetch(PDO::FETCH_ASSOC);

                if (!$access['edit_message']) {
                    echo ' <a class="btn btn-info" href="message_pets.php?idpets=' . $data['idpets'] . '">Забрать из приюта</a>';
                }
            }
            ?>


        </div>
    </div>

</div>
</body>
</html>

