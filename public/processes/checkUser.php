<?php

    require '../../private/db.connect.php';
    
    $q = ($_GET['q']!= "")? $_GET['q'] : null;
    
        
    // SELECT USERNAME FROM THE DATABASE
    $sth = $pdo->query("SELECT uname FROM user WHERE uname='$q';");
    
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if($row){
        echo('This username is already taken, please choose another');
    }    
    
    