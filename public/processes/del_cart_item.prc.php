<?php 
session_start();

// Check if deleteID has been sent
$deleteID = (isset($_POST['deleteID']) ? $_POST['deleteID'] : NULL);

// If deleteID has been set
// Delete that item from the Session
if (isset($deleteID) && ($deleteID !== NULL)) {
	unset($_SESSION['cart'][$deleteID]);
	$_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Redirect the user back to the Product page
header("Location: " . $_SERVER['HTTP_REFERER']);

?>