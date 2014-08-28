<?php

    require '../../private/db.connect.php';

    $id = ($_GET['id']!= "")? $_GET['id'] : null;
    $lvl = ($_GET['l']!= "")? $_GET['l'] : null;
        
        // SELECT USERNAME FROM THE DATABASE    
        $query = "UPDATE user SET access='$lvl' WHERE id='$id';";
        $pdo->query($query);
        
        echo('Completed');