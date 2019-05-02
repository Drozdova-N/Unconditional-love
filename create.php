<?php

require 'database.php';
$idpets = null; // id выбранного животного , если пользователь перешел со страницы page_pets.php
if(!empty($_GET['idpets'])) {

    $idpets= $_REQUEST['idpets'];
}

if (!empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $emailError = null;
    $passwordError = null;

    // keep track post values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idpets_1 = $_POST['idpets'];

    // validate input
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($password)) {
        $passwordError = 'Please enter password';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO user (name,email,password) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $email, $password));
        Database::disconnect();
        if ( null==$idpets_1 ) {

            header("Location: index.php");

        }
        else {  header("Location: signin.php?idpets=$idpets_1");

        }
       // header("Location: index.php");
    }
}

Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body >
<div id="lable_sign" align="left"> <img src="/img/image7.png" usemap="#image-map">
    <map name="image-map">
        <area target="" alt="Home" title="Home" href="home_page.php" coords="1,0,562,91" shape="rect">
    </map>
</div>

<div class="container">

    <div class="span10 offset1">


        <form class="form-signin" action="create.php" method="post">
            <h3>Create a User</h3>
            <input name="name" type="text" class="form-control" placeholder="User Name" required autofocus
                   value="<?php echo !empty($name) ? $name : ''; ?>">
            <?php if (!empty($nameError)): ?>
                <span class="help-inline"><?php echo $nameError; ?></span>
            <?php endif; ?>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address"
                   value="<?php echo !empty($email) ? $email : ''; ?>">
            <?php if (!empty($emailError)): ?>
                <span class="help-inline"><?php echo $emailError; ?></span>
            <?php endif; ?>

            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password"
                   required value="<?php echo !empty($password) ? $password : ''; ?>">
            <?php if (!empty($passwordError)): ?>
                <span class="help-inline"><?php echo $passwordError; ?></span>
            <?php endif; ?>
            <input type="hidden" name="idpets" value="<?php echo $idpets?>">
            <button class="btn btn-lg btn-primary btn-block"  href = "index.php" type="submit">Create user</button>
        </form>

    </div>

</div> <!-- /container -->
</body>
</html>
