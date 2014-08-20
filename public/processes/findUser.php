<?php

    require '../../private/db.connect.php';
    
    $q = ($_GET['q']!= "")? $_GET['q'] : null;
    
        
    // SELECT USERNAME FROM THE DATABASE
    $sth = $pdo->query("SELECT uname, id, access FROM user WHERE uname LIKE '$q%';");
        
        echo("<table>"
                . "<tr><th>User</th><th>Current Access</th></tr>");
    
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        echo("<tr id=".$row['id']."><td>".$row['uname']."</td><td style='text-align: right;'>".$row['access']."</td></tr>");
    }
    
    echo("</table>");
  
    