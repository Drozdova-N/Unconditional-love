<?php
$idpets = null;
if (!empty($_GET['idpets'])) {

    $idpets = $_REQUEST['idpets'];
}


include 'database.php';

if (!empty($_POST)) {

    // keep track validation errors
    $emailError = null;
    $passwordError = null;
    $signinError = null;

    // keep track post values
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idpets_1 = $_POST['idpets'];

    // validate input
    $valid = true;


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

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from user where email=? AND  password=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($email, $password));
        $user = $q->fetchAll();
        Database::disconnect();


        if (count($user) == 1) {
            session_start();
            $_SESSION['user'] = $email;
            $_SESSION['role'] = $user[0]['role_id'];
            $_SESSION['iduser'] = $user[0]['id'];

            if (null == $idpets_1) {

                header("Location: index.php");
            } else {
                header("Location: page_pets.php?idpets=$idpets_1");
            }
            //header("Location: index.php");
        } else

            $signinError = 'Please check email or password';
    }
}


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

<body>
<div id="lable_sign" align="left"><img src="/img/image7.png" usemap="#image-map">
    <map name="image-map">
        <area target="" alt="Home" title="Home" href="http://localhost/home_page.php" coords="1,0,562,91" shape="rect">
    </map>
</div>

<form class="form-signin" action="signin.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal  <?php echo !empty($signinError) ? 'text-danger' : '' ?>">
        <center><?php echo !empty($signinError) ? $signinError : 'Please sign in</center>'; ?></h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus
           action="create.php" method="post" value="<?php echo !empty($email) ? $email : ''; ?>">
    <?php if (!empty($emailError)): ?>
        <span class="help-inline"><?php echo $emailError; ?></span>
    <?php endif; ?>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required
           value="<?php echo !empty($password) ? $password : ''; ?>">
    <?php if (!empty($passwordError)): ?>
        <span class="help-inline"><?php echo $passwordError; ?></span>
    <?php endif; ?>
    <input type="hidden" name="idpets" value="<?php echo $idpets ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <br>

    <a href="create.php" class="btn btn-lg btn-primary btn-block">Registration</a>

</form>
</div>
</div>
</body>
</html>
