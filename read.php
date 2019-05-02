<?php
    require 'database.php' ;
session_start();

$pdo = Database::connect();
$sql_role = 'SELECT * FROM role where id = ?';
$q = $pdo->prepare($sql_role);
$q->execute(array($_SESSION['role']));
$access = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

$manage_users = false;
if ($access['manage_users']) {

    $manage_users = true;
}

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM user where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link   href="css/css_user.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">

    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
<div align="left"> <a <?php echo ($manage_users) ? 'href="users.php"' : 'href="pagemoderator.php"';?>> <img src="/img/image7.png"></a>

</div>
    <div id="container_for_user_1">
     
                <div id="container_for_user_2">
                    <div class="row">
                        <h3>Read a User</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
                        </div>
                      </div>
                        <?php if ($manage_users)
                        {
                            echo '<div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <label class="checkbox">';
                                     echo ''.$data['password'].'';
                     echo '   </label>
                    </div>
                </div>';
                        }?>

                        <div class="form-actions">
                          <a class="btn btn-info" href="index.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
