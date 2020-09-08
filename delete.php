<?php
require_once('connect.php');
session_start();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `liste` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
    $produit= $query->fetch();

    if(!$produit){
        $_SESSION['erreur'] = 'cette id n"existe pas';
        header('Location: index.php');
        die();
    }
    $sql = 'DELETE FROM `liste` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();

    $_SESSION['message'] = 'produit supprimé';
        header('Location: index.php');

}else{
    $_SESSION['erreur'] = 'URL INVALID';
    header('Location: index.php');
}
require_once('close.php');
