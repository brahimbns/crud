<?php

include_once('connect.php');
    
        $sql = 'SELECT * FROM `liste` ORDER BY `id`';
        $users = array();
        $query = $db->prepare($sql);
        $query->execute();
        while ($outPut = $query->fetch(PDO::FETCH_ASSOC)) {
            $users[$outPut['id']]=array(
                'id'    =>$outPut['id'],
                'produit'    =>$outPut['produit'],
                'prix'    =>$outPut['prix'],
                'nombre'    =>$outPut['nombre'],
                'actif'    =>$outPut['actif']
            );
        }
        $api=json_encode($users);
echo $api;
?>