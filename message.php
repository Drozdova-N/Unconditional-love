<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 01.11.18
 * Time: 1:53
 */
session_start();
include 'database.php';

$messageError=null;


$iduser=$_SESSION['iduser'];
$idpets=$_POST['idpets'];
$message = $_POST['message'];
 echo ''.$idpets.'';
//$state= 0; // статус заявки (0-заявка отправлена; 1 - заявка одобренна; -1 - заявка отклонена )
$valid = true;

if(empty($iduser))
{
    $valid = false;
    header("Location: index.php");
}

if(empty($message))
{
    $messageError = "Расскажите о себе";
    $valid = false;
}

if ($valid)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
    $sql = "insert into application (id_user, id_pets, message ) value (?,?,?)" ;
    $add = $pdo->prepare($sql);
    $add->execute(array($iduser, $idpets, $message ));
    Database::disconnect();
    header("Location: spasibo.php");
}
?>



