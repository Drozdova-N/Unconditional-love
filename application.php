<?php
include  "database.php";
$idapplication = null;
$state=null;
if ( !empty($_GET['id'])) {
    $idapplication= $_REQUEST['id'];
    $state = $_REQUEST['state'];
}
if ( null==$idapplication ) {
    header("Location: index.php");}
else {
    $pdo = Database::connect();
    $sql_update='UPDATE application set state=? where idapplication =?';
    $d = $pdo->prepare($sql_update);
    $d->execute(array($state,$idapplication));
    header("Location: pagemoderator.php");

}

