<?php
    require 'includes/header.inc.php';
?>

<script type="text/javascript">
    
    function submission(){
        
        var form = document.forms['permission'];
        var user = form['usearch'].value;
        
        checkUser(user);
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
    
    
</script>




<br>
    <strong>If you can see this and you are not an admin, please log out immediately.</strong><br>
    <br>
    <br>
    Change User Permissions.<br>
    - look up user and alter access level.<br>
    - admin - mod - user.
    <br>
    
    <form name="permission" action="#" onsubmit="return submission()">
        <input type="text" name="usearch" />
        <input type="submit" name="submit" value="Search"/>
    </form>
    
    <ul id="people"></ul>
    
    
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
