<?php
session_start(); 
include_once('connect.php');

$sql = 'SELECT * FROM `liste`';
$query = $db->prepare($sql);
$query->execute();
$result= $query->fetchAll(PDO::FETCH_ASSOC);

// var_dump($result[0]);

require_once('close.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>liste de tableaux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <main class="main">
        <div>
            <section class="col-8">
                <?php
                if(!empty($_SESSION['erreur'])){
                    echo'<div class="alert alert-danger" role="alert">
                    '.$_SESSION['erreur'].'
                  </div>';
                    $_SESSION['erreur']="";
                }
                ?>
                <?php
                if(!empty($_SESSION['message'])){
                    echo'<div class="alert alert-success" role="alert">
                    '.$_SESSION['message'].'
                  </div>';
                    $_SESSION['message']="";
                }
                ?>
                <h1>liste des produits</h1>
                <table class="table">
                    <thead>
                        <th>id</th>
                        <th>produit</th>
                        <th>prix</th>
                        <th>nombre</th>
                        <th>actif</th>
                        <th>actions</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $produit)
                        {
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['produit'] ?></td>
                                <td><?= $produit['prix'] ?></td>
                                <td><?= $produit['nombre'] ?></td>
                                <td><?= $produit['actif'] ?></td>
                                <td>
                                    <a href="disable.php?id=<?=$produit['id']?>" >A/D </a>
                                    <a href="details.php?id=<?=$produit['id']?>" >voir </a>
                                    <a href="edit.php?id=<?=$produit['id']?>" > modifier</a>
                                    <a href="delete.php?id=<?=$produit['id']?>" > supprimer</a>
                                </td>
                            </tr>        
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>
</html>