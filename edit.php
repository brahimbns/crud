<?php
session_start(); 
if($_POST){
    // die('ca marche');
    if(
        isset($_POST['id']) && !empty($_POST['id'])&&
        isset($_POST['produit']) && !empty($_POST['produit'])&&
        isset($_POST['prix']) && !empty($_POST['prix'])&&
        isset($_POST['nombre']) && !empty($_POST['nombre'])
    ){
        include_once('connect.php');

        $id = strip_tags($_POST['id']);
        $produit = strip_tags($_POST['produit']);
        $prix = strip_tags($_POST['prix']);
        $nombre = strip_tags($_POST['nombre']);

        $sql = 'UPDATE `liste` SET `produit`=:produit, `prix`:=prix, `nombre`:=nobmre WHERE `id`=:id';
        $query = $db->prepare($sql);
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->bindValue(':produit',$produit, PDO::PARAM_STR);
        $query->bindValue(':prix',$prix, PDO::PARAM_INT);
        $query->bindValue(':nombre',$nombre, PDO::PARAM_INT);
        $query->execute();

        $_SESSION['message'] = 'prouit modifier';
        require_once('close.php');
        header('Location: index.php');
    }else{
        $_SESSION['erreur']="le formuler n'est pas complet";
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');
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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>modifier produit</title>
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
                <h1>modifier produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="produit">produit</label>
                        <input type="text" id="produit" name="produit" class="form-control" value="<?=$produit['produit']?>">
                    </div>
                    <div class="form-group">
                        <label for="prix">prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" value="<?=$produit['prix']?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre">nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?=$produit['nombre']?>">
                    </div>
                    <input type="hidden" value="<?=$produit['id']?>"  name="id">
                    <button class="btn btn-primary">envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>