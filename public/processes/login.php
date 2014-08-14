<?php

    // START SESSION and set VARIABLES
    session_start();
    $user = ($_POST['user']!= "")? $_POST['user'] : null;
    $pass = ($_POST['pass']!= "")? $_POST['pass'] : null;
    $_SESSION['login'] = false;
    $page = $_SERVER['HTTP_REFERER'];
   
    require '../../private/db.connect.php';
    require '../../private/salt.pepper';
    
    // FUNCTION TO CHANGE PAGE
    function redirect($url)
    {
        header("Location: $url");
        die();
    }
        
    // SELECT USERNAME AND EMAIL FROM THE DATABASE
    $sth = $pdo->query("SELECT uname, pword, lastVisit FROM user WHERE uname='$user';");
    
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $un = $row['uname'];
    $up = $row['pword'];
    $lv = $row['lastVisit'];
    
    $encrypt = $pass.$salt.$lv;
    $hashed = hash('sha512', $encrypt);
    
    // SET SESSION TO LOGGED IN IF USER EXISTS AND PASSWORD IS CORRECT
    if(($un == $user) && ($up == $hashed)){
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        
        $date = new DateTime();
        $dateStamp = $date->format('Y-m-d H:i:s');
        
        $newEncrypt = $pass.$salt.$dateStamp;
        $newHash = hash('sha512', $newEncrypt);
        
        $query = "UPDATE user SET lastVisit='$dateStamp', pword='$newHash' WHERE uname='$user';";
        $pdo->query($query);
        
        redirect($page);
        }
    redirect("../register.php");
