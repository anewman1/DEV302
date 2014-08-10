<?php

    // START SESSION and set VARIABLES
    session_start();
    $user = (isset($_POST['user'])!= "")? $_POST['user'] : null;
    $pass = (isset($_POST['pass'])!= "")? $_POST['pass'] : null;
    $email = (isset($_POST['email'])!= "")? $_POST['email'] : null;
    
    require '../../private/salt.pepper';
    
    // FUNCTION TO CHANGE PAGE
    function redirect($url)
    {
        header("Location: $url");
        die();
    }
    
    $encrypt = $pass.$salt;
    
    $hashed = hash('sha512', $encrypt);
    
    
    
    //FILE OPERATIONS
    $file = "login.details";
    $fh = fopen($file, "r+");
    
    while($line = fgets($fh))
    {
        $details = explode("_##_", $line);
        if($user == $details[0])
        { // CHECKS USERNAME AVAILABILITY
            echo("The username $user is already taken, please select another.");
            fclose($fh);
            break;
        }elseif($email == $details[2])
        { // CHECKS EMAIL AVAILABILITY
           echo("That email address is already registered. Please log in.");
            fclose($fh);
            break; 
        }
    }
    
    // WRITES NEW USER DETAILS AND SETS VALUES FOR USE ON OTHER PAGES
    if(is_resource($fh))
    {
        fwrite($fh, "\n$user"."_##_"."$hashed"."_##_"."$email"."_##_"."$sub");
        fclose($fh);
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        redirect("../index.php");
    }
    