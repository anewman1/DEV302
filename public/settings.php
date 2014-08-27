<?php
require 'includes/header.inc.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html>
    
    <body>
        <div class="sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li class="active">
                <a href="#personal">Personal Info</a>
            </li>
        </ul>
        </div>
        
        <div class="personal">
            <?php
                require('../private/db.connect.php');
                
                
               
		$query = 
                
                //if the current $USER === $uname
                // find current user logged in
                        ("SELECT title, fname, lname, email, phone, pword "
                        . "FROM user "
                        . "WHERE uname = '".$_SESSION['user']."' LIMIT 1"
                        // do two database queries in the same page
                        . "UNION"
              
                //find the address linked to the current user logged in
                //get the id of the current uname logged in
                        . "SELECT unitNum, streetNum, streetName, streetType"
                        . "FROM address, user "
                        . "WHERE uname = '".$_SESSION['user']."' user.id = address.user_id'"

                        );
		$sth = $pdo->query($query);
		
		while( $row = $sth->fetch(PDO::FETCH_ASSOC) )
		{
	?>
            
            <div class="name"> <label>Name</label> <span><?=$row['title'];?><?=$row['fname'];?> <?=$row['lname'];?></span><a href="#changename">Change</a></div>
            <div class="email"> <label>Email</label> <span><?=$row['email'];?></span> <a href="#changeemail">Change</a></div>
            
            <div class="Phone"><label>Phone</label><span><?=$row['phone'];?></span><a href="#changephone">Change</a></div>
            <div class="Password"> <label>Password</label><span></span><a href="#changepass">Change</a></div>
            
             <div class="address"> <label>Address</label> <span><?=$row['unitNum'];?><?=$row['streetNum'];?><?=$row['streetName'];?><?=substr($row['streetType'],0, 10);?>...</span><a href="#changeaddress">Change</a></div>
           <?php
                }
           ?>   
            
        </div>
        
    </body>

</html>
    
<?php
require 'includes/footer.inc.php';

