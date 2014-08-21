<?php

    require '../../private/db.connect.php';
    
    if(isset($_GET['q'])){
        $q = $_GET['q'];
        
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
    }    
    
    
    if(isset($_GET['t'])){
        $t = $_GET['t'];
        
        // SELECT USERNAME FROM THE DATABASE
        $sth = $pdo->query("SELECT uname, id FROM user WHERE uname LIKE '$t%';");
        echo("<table>"
                . "<tr><th>User</th><th>Delete User</th></tr>");
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
        
            echo("<tr id=".$row['id'].">"
                . "<td>".$row['uname']."</td>"
                . "<td style='text-align: center;'><button onclick='delID(\"".$row['id']."\", \"".$row['uname']."\")'>Delete</button></td>"
                . "</tr>");
        }
        echo("</table>");  
    }
    
    if(isset($_GET['u'])){
        $u = $_GET['u'];    
        
    // SELECT USERNAME FROM THE DATABASE
    $sth = $pdo->query("SELECT uname FROM user WHERE uname='$u';");
    
    $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($row){
            echo('This username is already taken, please choose another');
        }
    }
    
    
//        
//    // SELECT USERNAME FROM THE DATABASE
//    $sth = $pdo->query("SELECT uname, id, access FROM user WHERE uname LIKE '$query%';");
//        
//        echo("<table>"
//                . "<tr><th>User</th><th>Current Access</th><th>Change to</th><th>Confirm</th></tr>");
//    
//    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
//        $id = $row['id'];
//        
//        echo("<tr id=".$row['id'].">"
//                . "<td>".$row['uname']."</td>"
//                . "<td style='text-align: center;'>".$row['access']."</td>"
//                . "<td><select name='newLVL'><option value='user'>user</option><option value='mod'>mod</option><option value='admin'>admin</option><select></td>"
//                . "<td><button onclick='uID(\"".$row['id']."\", \"".$row['uname']."\", \"".$row['access']."\")'>Change</button></td>"
//                . "</tr>");
//    }
//    
//    echo("</table>");
//  
//    