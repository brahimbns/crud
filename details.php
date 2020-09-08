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
    }
}else{
    $_SESSION['erreur'] = 'URL INVALID';
    header('Location: index.php');
}
require_once('close.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details du produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-8">
                <h1>Details produit : <?= $produit['produit']?></h1>
                <p>ID: <?= $produit['id']?></p>
                <p>produit: <?= $produit['produit']?></p>
                <p>prix: <?= $produit['prix']?></p>
                <p>nombre: <?= $produit['nombre']?></p>
                <p><a href="index.php">Retour</a><a href="edit.php?id=<?=$produit['id']?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>