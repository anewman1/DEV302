<?php
require 'includes/header.inc.php';
?>

<script type="text/javascript">
    function validateForm(){
        var form = document.forms['signup'];
        
        var fname = form['fname'].value;
        var lname = form['lname'].value;
        var phone = form['phone'].value;
        var dob = form['dob'].value;
        var email = form['email'].value;
        var user = form['user'].value;
        var pass = form['pass'].value;
        var conf = form['confirm'].value;
        
        //Set password minimum length
        if(pass.length < 6){
            alert('Password must contain a minimum of 6 characters');
            return false;
        }
        
        //Ensures at least one number is present
        var regEx = /[0-9]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one number');
            return false;
        }
        
        //Ensures at least one UPPERCASE letter is present
        var regEx = /[A-Z]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one UPPERCASE letter');
            return false;
        }
        
        //Ensures at least onelowercase letter is present
        var regEx = /[a-z]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one lowercase letter');
            return false;
        }
        
        //Ensure the user knows their password
        if(pass !== conf){
            alert('Passwords do not match');
            return false;
        }
        
    }
</script>

<form method="POST" action="processes/signup.prc.php" name="signup" onsubmit="return validateForm()">
    First Name: <input type="text" name="fname" required /><br>
    Last Name: <input type="text" name="lname" required /><br>
    Phone Number: <input type="tel" name="phone" required /><br>
    Date of Birth: <input type="date" name="dob" required /><br>
    
    Email Address: <input type="email" name="email" required /><br>
    Username: <input type="text" name="user" required /><br>
    Password: <input type="password" name="pass" required /><br>
    Confirm Password: <input type="password" name="confirm" required /><br>
    
    <input type="submit" value="submit"/>
</form>

<?php
require 'includes/footer.inc.php';
?>
