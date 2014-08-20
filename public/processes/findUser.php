<?php

    require '../../private/db.connect.php';
    
    $q = ($_GET['q']!= "")? $_GET['q'] : null;
    
        
    // SELECT USERNAME FROM THE DATABASE
    $sth = $pdo->query("SELECT uname, id, access FROM user WHERE uname LIKE '$q%';");
        
        echo("<table>"
                . "<tr><th>User</th><th>Current Access</th><th>Change to</th><th>Confirm</th></tr>");
    
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id'];
        
        echo("<tr id=".$row['id'].">"
                . "<td>".$row['uname']."</td>"
                . "<td style='text-align: center;'>".$row['access']."</td>"
                . "<td><select name='newLVL'><option value='user'>user</option><option value='mod'>mod</option><option value='admin'>admin</option><select></td>"
                . "<td><button onclick='uID(\"".$row['id']."\", \"".$row['uname']."\", \"".$row['access']."\")'>Change</button></td>"
                . "</tr>");
    }
    
    echo("</table>");
  
    