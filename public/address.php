<?php
    require 'includes/header.inc.php';
?>


    <div class="address-form">
<form method="POST" action="processes/addAddress.prc.php" name="addAddress">
      
    <label>Unit Number</label><br />
    <input class="unitNum" type="number" name="unitNum" /><br><br>
    <label>Street Name</label><br />
    <input class="streetName" type="text" name="streetName" /><br><br>
    <label>Street Type</label><br />
    <input class="streetType" type="text" name="streetType" /><br><br>
    <label>Street Suffix</label><br />
    <input class="streetSuffix" type="text" name="streetSuffix" /><br><br>
    <label>Suburb</label><br />
    <input class="suburb" type="text" name="suburb" /><br><br>
    <label>State</label><br />
    <input class="state" type="text" name="state" /><br><br>   
    <label>Postcode</label><br />
    <input class="postcode" type="number" name="postcode" /><br><br>
    
    <input type="submit" value="submit"/>
</form>
    </div>

<script>
    function validateAddress (){
        
        var form = document.forms['addAddress'];
        
        var unitNum = form['unitNum'].value;
        var streetName = form['streetName'].value;
        var streetType = form['streetType'].value;
        var streetSuffix = form['streetSuffix'].value;
        var suburb = form['suburb'].value;
        var state = form['state'].value;
        var postcode = form['postcode'].value;
        
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
        
        checkUser(user);
        
    }
    
    
</script>
<?php
    require 'includes/footer.inc.php';
?>