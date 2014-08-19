<?php

    // START SESSION and set VARIABLES
    session_start();
    $fname = (isset($_POST['fname'])!= "")? $_POST['fname'] : null;
    $lname = (isset($_POST['lname'])!= "")? $_POST['lname'] : null;
    $phone = (isset($_POST['phone'])!= "")? $_POST['phone'] : null;
    $email = (isset($_POST['email'])!= "")? $_POST['email'] : null;
    $user = (isset($_POST['user'])!= "")? $_POST['user'] : null;
    $pass = (isset($_POST['pass'])!= "")? $_POST['pass'] : null;
    $confirm = (isset($_POST['confirm'])!= "")? $_POST['confirm'] : null;
    
    $day = (isset($_POST['day'])!= "")? $_POST['day'] : null;
    $month = (isset($_POST['month'])!= "")? $_POST['month'] : null;
    $year = (isset($_POST['year'])!= "")? $_POST['year'] : null;
    
    
    
    require '../../private/db.connect.php';
    require '../../private/salt.pepper';
    
    // FUNCTION TO CHANGE PAGE
    function redirect($url)
    {
        header("Location: $url");
        die();
    }
    
    $encrypt = $pass.$salt.'0000-00-00 00:00:00';
    $hashed = hash('sha512', $encrypt);
    
    // VALIDATE THE DATE INPUT
    if(checkdate($month, $day, $year)){
        $dob = "$year-$month-$day";
    }
    

    
    // SELECT USERNAME AND EMAIL FROM THE DATABASE
    $sth = $pdo->query("SELECT uname, email FROM user WHERE uname='$user' OR email='$email';");
    
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $un = $row['uname'];
    $ue = $row['email'];
    
    // CHECK IF USERNAME IS ALREADY TAKEN
    if($un == $user){
        echo('This username is already taken, please select another.');
        
    // CHECK IF EMAIL IS ALREADY REGISTERED
    }else if($ue == $email){
        echo('This is email is already registered, please log in.');
        
    // IF USER AND EMAIL ARE OK, THEN CREATE NEW USER IN THE DATABASE
    }else{
        $query = "INSERT INTO user SET id='NULL', uname='$user', email='$email', fname='$fname', lname='$lname', pword='$hashed', dob='$dob', phone='$phone', date=CURRENT_TIMESTAMP, access='user', lastVisit='0000-00-00 00:00:00';";
        $pdo->query($query); 
        redirect('../index.php');
    } 
        
