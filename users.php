<?php
include 'database.php';
session_start();  // старт сессии

// проверка сесии
if (!isset($_SESSION['user'])) {
    Database::disconnect();
    header("Location: signin.php");
    die();
}

$pdo = Database::connect();
$sql_role = 'SELECT * FROM role where id = ?'; //составлене запроса для получения роли пользователя который находится в сессии
$q = $pdo->prepare($sql_role); //подготовка запроса к выполнению и возвращение связанного с этим запросом объекта
$q->execute(array($_SESSION['role'])); // запуск подготовленного запроса на выполнение
$access = $q->fetch(PDO::FETCH_ASSOC); //  извлечение следующей строки из результирующего набора
//проверка роли пользователя
if ($access['manage_users']) {
    $sql = 'SELECT * FROM user_data  ORDER BY id DESC';  // составление запроса для получения массива строк из таблицы user с испльзование предстваления 'user_data'
    $rows = $pdo->query($sql); // выполнение запроса
    Database::disconnect();
} else {
    Database::disconnect();
    header("Location: 404.php"); // перенаправление на страницу 404.php если пользователь без привелегий пытается получить доступ к списку пользователей
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon " href="img/favicon.ico" type="image/x-icon">
    <title>mysite.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/dropdown_menu.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div id="coco2">
    <a class="btn btn-default" href="signout.php">Sign out </a>
</div>
<div  align="left"> <a href="users.php"> <img src="/img/image7.png"></a></div>

<div class="container">
    <div class="row">
        <h3>User List <?php if ($rows->rowCount() == 0) echo 'is Empty'; ?></h3>
    </div>

    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Create user</a>

        </p>
        <?php // заполнение таблицы пользователей в цикле
        if ($rows->rowCount() > 0) {
            echo '<table class="table table-striped table-bordered">
                   		<thead>
                          		<tr>
                           		<th>Name</th>
                            	<th>Email Address</th>
                           		<th>Password</th>
                           		<th>Role</th>
                           		<th>Action</th>
                       			</tr>
                      		</thead>';
            echo '<tbody>';
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td>' . $row['role'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-info" href="read.php?id=' . $row['id'] . '">Read</a>';
                echo ' ';
                echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Update</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>
      			</table> ';
        } else  echo '<img width="100%"  src="img/cit.jpg">';

        ?>

    </div>
</div>
</body>
</html>
 
