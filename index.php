<?php
require 'database.php';
session_start();

if (!isset($_SESSION['user'])) {
    //Database::disconnect();
    header("Location: signin.php");
    die();
}

$pdo = Database::connect();
$sql_role = 'SELECT * FROM role where id = ?';
$q = $pdo->prepare($sql_role);
$q->execute(array($_SESSION['role']));
$access = $q->fetch(PDO::FETCH_ASSOC);

if ($access['manage_users']) {
    Database::disconnect();
    header("Location: users.php");
} elseif ($access['edit_message']) {
    Database::disconnect();
    header("Location: pagemoderator.php");
}
else {
    Database::disconnect();
    header("Location: home_page.php");
}

