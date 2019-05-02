<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 26.10.18
 * Time: 20:21
 */
include "database.php";
session_start();

if (!isset($_SESSION['user'])) {
    Database::disconnect();
    header("Location: signin.php");
    die();
}

$pdo = Database::connect();
$sql_role = 'SELECT * FROM role where id = ?';
$q = $pdo->prepare($sql_role);
$q->execute(array($_SESSION['role']));
$access = $q->fetch(PDO::FETCH_ASSOC);

if ($access['edit_message']) {


    $sql = 'SELECT * FROM application_from  ORDER BY id DESC';
    $rows = $pdo->query($sql);

    Database::disconnect();
} else {
    Database::disconnect();
      header("Location: 404.php");
    die();
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>


<body>
<div align="left"> <a href="pagemoderator.php"> <img src="/img/image7.png"></a>
    <div id="coco2">
        <a class="btn btn-default" href="signout.php">Sign out </a>
    </div><center><h3>Moderator</h3></center></div>

    <div id="menu">
        <ul id="nav">
        <li>
            <a href="add_pets.php" title="">Add pets</a>
        </li>
        <li>
            <a href="add_news.php" title=""> Add News  </a>
        </li>
        <li>
            <a href="news.php" title=""> List News  </a>
        </li>
        <li>
            <a href="list_pets.php" title="List pets">Pets</a>
            <ul>
                <li><a href="list_pets.php?type=cats">Cats</a></li>
                <li> <a href="list_pets.php?type=dogs">Dogs</a></li>
                <li><a href="list_pets.php?type=other">Other</a></li>
            </ul>
        </li>
    </ul>
</div>

    <br>
<div class="container">
<form action="application.php" method="get">
    <div class="row">
        <h3> Users of the application <?php if ($rows->rowCount() == 0) echo 'is Empty'; ?></h3>
    </div>
    <div class="row">

    <?php
if ($rows->rowCount() > 0) {
    echo '<table class="table table-striped table-bordered">
                   		<thead>
                          		<tr>
                          		<th> № </th>
                           		<th>Name user</th>
                            	<th>Email Address</th>
                           		<th>Nickname Pets</th>
                           		<th>Message user</th>
                           		<th>State</th>
                       			</tr>
                      		</thead>';
    echo '<tbody>';
    $i = 1 ;
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td><a href="read.php?id=' . $row['iduser'] . '">' . $row['name'] . '</a></td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="page_pets.php?idpets='.$row['idpets'].'">' . $row['nickname'] . '<br>
                <img src="' . $row['photo'] . '" style="height: 40px; width: 40px;"></a>
                </td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td width=250>';
          if($row['state']==1)
          {   echo '<a> Принята<a><br>';
              echo '<a  class="btn btn-info" href="delete_pets.php?id='.$row['id'].'&idpets='.$row['idpets'].'">Забрали</a>';
              echo ' <a  class="btn btn-info" href="delete_pets.php?id='.$row['id'].'">Не забрали</a>';
          }
          elseif ($row['state']==-1)
          {
              echo '<a>Отклонена</a><br>';
              echo '<a  class="btn btn-danger" href="delete_pets.php?id='.$row['id'].'"?>Удалить из списка</a>';

          }
          else
        {echo '<a  class="btn btn-info" href="application.php?id='.$row['id'].'&state=1">Принять</a>';
        echo ' ';
        echo '<a  class="btn btn-danger" href="application.php?id='.$row['id'].'&state=-1"?>Отклонить</a>';
        }
        echo '</tr>';
        $i++;
    }
    echo '</tbody>
      			</table> ';

} else  echo '<img width="100%"  src="img/cit.jpg">';

?>

    </div></div>
</body>
</html>
