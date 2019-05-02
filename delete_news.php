<?php
/**
 * Created by PhpStorm.
 * User: dnina
 * Date: 07.11.18
 * Time: 12:13
 */

$idnews = null;
if(!empty($_GET['idnews']))
{
    $idnews = $_REQUEST['idnews'];
}
 if(null == $idnews)
 {

     header("Location: index.php");
 }
 else {
     include "database.php";
     $pdo = Database::connect();


     $sql = 'select * from news where idnews=?';
     $q=$pdo->prepare($sql);
     $q->execute(array($idnews));
     $data = $q->fetch(PDO::FETCH_ASSOC);
     $path_photo = '/var/www/html/'.$data['image'];

     if ( !(unlink($path_photo)) )
     {
         header("Location: 404.php");
     }

     $sql_delete_news = 'delete from news where idnews=?';
     $q = $pdo->prepare($sql_delete_news);
     $q->execute(array($idnews));
     Database::disconnect();
     header("Location: news.php");
 }
