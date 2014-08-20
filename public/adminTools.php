<?php
    require 'includes/header.inc.php';
?>

<script type="text/javascript">
    
    function permissions(){
        
        var form = document.forms['permission'];
        var user = form['usearch'].value;
        
        // Implemented REGEX here as leaving it blank or entering spaces would return all users.
        var regEx = /^[a-zA-Z0-9]+$/;
        if(!regEx.test(user)){
            alert('Please enter a valid search');
        }else{
            checkUser(user);
        }
        return false;
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
                document.getElementById('people').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "processes/findUser.php?q="+str, true);
        xmlhttp.send();
    }
    
    function uID(id, name, access){
        var uID = id;
        var uname = name;
        var aLvl = access;
        var newLVL = $("#"+uID+" option:selected").val();
        var txt = uname+" is currently a "+aLvl+".\nYou are about to set them as a "+newLVL+". \nEnter your password to confirm";
        
        prompt(txt, "password");
    }

</script>




<br>
    <strong>If you can see this and you are not an admin, please log out immediately.</strong><br>
    <br>
    <br>
    Change User Permissions.<br>
    <br>
    
    <form name="permission" action="#" onsubmit="return permissions()">
        <input type="text" name="usearch" />
        <input type="submit" name="submit" value="Search"/>
    </form>
    <br>
    <div id="people"></div>

    
    <br>
    Delete User.<br>
    - look up user and delete account.
    <br>
    <br>
    Reset User Password.<br>
    - look up user and reset their password.
    <br>
    <br>
    Alter Products.<br>
    - Add/Remove products / Alter Product price and other details.
    <br>
    <br>
<?php
    require 'includes/footer.inc.php';
?>
