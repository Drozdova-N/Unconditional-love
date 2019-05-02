<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <title>mysite.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel='stylesheet' href='/css/bootstrap.min.css' type='text/css' media='all'>
    <link href="css/signin.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.min.js"></script>
    <link type="text/css" href="css/slider_for_allpages.css" rel="stylesheet">
    <link type="text/css" href="css/slider.css" rel="stylesheet">
    <link type="text/css" href="css/css_home.css" rel="stylesheet">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">



</head>
<body>

<ul class="body_slides">
    <li></li>
    <li></li>
    <li></li>
</ul>
<div>

    <div align="left"> <img src="/img/image7.png" usemap="#image-map">

        <map name="image-map">
            <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
        </map> </div>
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
<br><br><br>

<div id="container_for_about_1">
    <div class='sliderA' >
        <input type="radio" name="slider2" id="slider2_1" checked="checked">
        <label for="slider2_1"></label>
        <div>
            <img src="/img/image.png" style="height: 500px; width: 500px;">
        </div>
        <label for="slider2_2"></label>

        <input type="radio" name="slider2" id="slider2_2">
        <label for="slider2_2"></label>
        <div>
            <img src="/img/slider1.jpg" style="height: 500px; width: 470px;">
        </div>
        <label for="slider2_3"></label>

        <input type="radio" name="slider2" id="slider2_3">
        <label for="slider2_3"></label>
        <div>
            <img src="/img/slider2.jpg" style="height: 500px; width: 500px;">
        </div>
        <label for="slider2_4"></label>

        <input type="radio" name="slider2" id="slider2_4">
        <label for="slider2_4"></label>
        <div>
            <img src="/img/slider3.jpg" style="height: 500px; width: 500px;">
        </div>
        <label for="slider2_5"></label>

        <input type="radio" name="slider2" id="slider2_5">
        <label for="slider2_5"></label>
        <div>
            <img src="/img/slider4.jpg" style="height: 500px; width: 500px;">
        </div>
        <label for="slider2_1"></label>
    </div>
    <div id="container_for_about_2">
    <h1 class="display-4 font-italic">About our shelter </h1>
    <h2 class="display-4 font-italic"> "Unconditional love"</h2>
    <p class="lead my-3">
        Animal shelter "Unconditional love" considers caring for our smaller brothers as their primary task.
        Caring for stray animals is a responsibility that lies on the shoulders of the staff of the animal shelter.
        Fluffy wards need a master, and that you can become him.</p>
        <p>On our site are profiles of all the animals of the shelter, which can be picked up right now.</p>
        <p>The organization is located at 247 k2 Institutsky Avenue</p>
    </div>

</div>
    <!--<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <font face="Arial">


            <p>On our site are profiles of all the animals of the shelter, which can be picked up right now.</p>
                <p>The organization is located at 247 k2 Institutsky Avenue</p></font>
        </div>

    </div>-->
</body>
</html>





