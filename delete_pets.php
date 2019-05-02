<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 05.11.18
 * Time: 13:14
 */

include "database.php";
$idapplication = null;
$idpets= null;

if ( !empty($_GET['id'])) {
    $idapplication= $_REQUEST['id'];

}
if(!empty($_GET['idpets']))
{
    $idpets = $_REQUEST['idpets'];
}
if ( null==$idpets ) {

    $pdo = Database::connect();
    $sql_delete='delete from application where idapplication =?';
    $d = $pdo->prepare($sql_delete);
    $d->execute(array($idapplication));

    Database::disconnect();
    header("Location: pagemoderator.php");
}
else
{    $pdo = Database::connect();

    $sql = 'select * from pets where idpets=?';
    $q=$pdo->prepare($sql);
    $q->execute(array($idpets));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $path_photo = '/var/www/html/'.$data['photo'];

    if ( !(unlink($path_photo)) )
    {
        header("Location: 404.php");
    }

    $sql_delete='delete from application where idapplication =?';
    $d = $pdo->prepare($sql_delete);
    $d->execute(array($idapplication));

    $sql_delete_pets = 'delete from pets where idpets=?';
    $q = $pdo->prepare($sql_delete_pets);
    $q->execute(array($idpets));
    Database::disconnect() ;
    header("Location: pagemoderator.php");
}
