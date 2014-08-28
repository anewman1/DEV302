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
    
    // Function to call the php script for database lookup
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
        xmlhttp.open("GET", "processes/findUser.prc.php?q="+str, true);
        xmlhttp.send();
    }

    function deletions(){
        
        var form = document.forms['deletion'];
        var user = form['usearch'].value;
        
        // Implemented REGEX here as leaving it blank or entering spaces would return all users.
        var regEx = /^[a-zA-Z0-9]+$/;
        if(!regEx.test(user)){
            alert('Please enter a valid search');
        }else{
            lookUpUser(user);
        }
        return false;
    }
    
    // Function to call the php script for database lookup
    function lookUpUser(str){
        if(window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('del').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "processes/findUser.prc.php?t="+str, true);
        xmlhttp.send();
    }

    // Function for changing user permissions.
    function uID(id, name, access){
        var uID = id;
        var uname = name;
        var aLvl = access;
        var newLVL = $("#"+uID+" option:selected").val();
        var txt = uname+" is currently a "+aLvl+".\nYou are about to set them as a "+newLVL+". \nAre you sure you wish to do this?";
        
        var conf = confirm(txt);
        if(conf == true){
            alterUser(uID, newLVL);
            alert(uname+" is now a "+newLVL);
        }
    }

    // Function for deleting a user from the databse.
    function delID(id, name){
        var uID = id;
        var uname = name;
        var txt = "You are about to delete the account for "+uname+" from the system.\nAre you sure you want to do this?";
        
        var conf = confirm(txt);
        if(conf == true){
            alert(uname+"'s account has been deleted... Not really.");
        }
    }

    // Function to call the php script to alter user permissions
    function alterUser(id, lvl){
        if(window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }else{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('del').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "processes/alterUser.prc.php?id="+id+"&l="+lvl, true);
        xmlhttp.send();
    }


</script>




<br>
    <strong>If you can see this and you are not an admin, please log out immediately.</strong><br>
    <br>
    <br>
    Change User Permissions.<br>   
    
    <form name="permission" action="#" onsubmit="return permissions();">
        <input type="text" name="usearch" />
        <input type="submit" name="submit" value="Search"/>
    </form>
    <br>
    <div id="people"></div>

    
    <br>
    Delete User.<br>
    - Do we delete a user or do we have another database field of if the account is active or not, and do not allow access if its inactive?<br>
    - This would also prevent a user from rejoining if they were banned as username and email would still be registered, just not accesaable.<br>
    
    <form name="deletion" action="#" onsubmit="return deletions();">
        <input type="text" name="usearch" />
        <input type="submit" name="submit" value="Search"/>
    </form>
    <br>
    <div id="del"></div>
    
    
    
    <br>
    Reset User Password.<br>
    - look up user and reset their password.
    <br>
    - Do we need this feature in this database? It could autogen a new password and email it to the user if email functions were enabled. <br>
    Or, we could just allow the admin to enter a new one manually and then advise the user what it is?
    <br>
    <br>
    <br>
    Alter Products.<br>
    - Add/Remove products / Alter Product price and other details.
    <br>
    - Sheldon was working products, I believe he was working on this step.
    <br>
    
    
    
<?php
    require 'includes/footer.inc.php';
?>
