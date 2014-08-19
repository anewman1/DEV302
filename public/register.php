<?php
require 'includes/header.inc.php';
?>

<script type="text/javascript">   
    function validateForm(){
        var form = document.forms['signup'];
        
        var fname = form['fname'].value;
        var lname = form['lname'].value;
        var phone = form['phone'].value;
//        var dob = form['dob'].value;
//        var email = form['email'].value;
        var user = form['user'].value;
        var pass = form['pass'].value;
        var conf = form['confirm'].value;
        
        
        var regEx = /[0-9]/;
        if(regEx.test(fname)){
            alert('Please enter a valid name');
            return false;
        }
        
        var regEx = /^[a-zA-Z0-9]+$/;
        if(!regEx.test(user)){
            alert('Please only use alphanumeric characters for your uesrname');
            return false;
        }
        
        
        // SET PASSWORD MINIMUM LENGTH
        if(pass.length < 6){
            alert('Password must contain a minimum of 6 characters');
            return false;
        }
        
        // ENSURES AT LEAST ONE NUMBER IS PRESENT
        var regEx = /[0-9]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one number');
            return false;
        }
        
        // ENSURES AT LEAST ONE UPPERCASE LETTER IS PRESENT
        var regEx = /[A-Z]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one UPPERCASE letter');
            return false;
        }
        
        // ENSURES AT LEAST ONE LOWERCASE LETTER IS PRESENT
        var regEx = /[a-z]/;
        if(!regEx.test(pass)){
            alert('Password must contain at least one lowercase letter');
            return false;
        }
        
        // ENSURE THE USER KNOWS THEIR PASSWORD
        if(pass !== conf){
            alert('Passwords do not match');
            return false;
        }
        
        checkUser(user);
        
    }
    
    function checkUser(str){
        if(window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('taken').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "processes/getuser.php?q="+str, false);
        xmlhttp.send();
    }
</script>

<form method="POST" action="processes/signup.prc.php" name="signup" onsubmit="return validateForm()">
    First Name: <input type="text" name="fname" required /><br>
    Last Name: <input type="text" name="lname" required /><br>
    Phone Number: <input type="tel" name="phone" required /><br>
    Date of Birth: 
    
    <select name="day">
        <?php
            for($i=1; $i<32; $i++){
                if($i<10){
        ?>
            <option value="<?='0'.$i?>"><?='0'.$i?></option>
        <?php
            }else{
        ?>
                <option value="<?=$i?>"><?=$i?></option>
        <?php
            }}
        ?>
    </select>
    <select name="month">
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    <select name="year">
        <?php
            for($i=2002; $i>1900; $i--){
        ?>
            <option value="<?=$i?>"><?=$i?></option>
        <?php
            }
        ?>
    </select>
    <br>
    
    
    
    Email Address: <input type="email" name="email" required /><br>
    <span style="font-size: 0.8em">Username must only contain letters and numbers.</span><br>
    Username: <input type="text" name="user" required /><span id="taken"></span><br>
    <span style="font-size: 0.8em">Password must contain a minimum of six(6) characters, an uppercase, lowercase and a number.</span><br>
    Password: <input type="password" name="pass" required /><br>
    Confirm Password: <input type="password" name="confirm" required /><br>
    
    
    
    
    <input type="submit" value="submit"/>
</form>

<?php
require 'includes/footer.inc.php';
?>
