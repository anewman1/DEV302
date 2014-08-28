<?php 

// Collect user input information
$productID = (isset($_POST["productID"]) && $_POST["productID"] != "") ? $_POST["productID"] : NULL;
$reviewer = (isset($_POST["reviewer"]) && $_POST["reviewer"] != "") ? $_POST["reviewer"] : NULL;
$rating = (isset($_POST["rating"]) && $_POST["rating"] != "") ? $_POST["rating"] : NULL;
$reviewText = ((isset($_POST["reviewText"]) && $_POST["reviewText"] != "") ? $_POST["reviewText"] : NULL);

// Load user input information into Review array
$review = array($productID, $rating, $reviewer, $reviewText);

// Open the Reviews file
// Note: Use a protocol to avoid overwriting file
$file = "../data/reviews.csv";
$fh = fopen($file , "a");
// Add the review to the end of the file
fputcsv($fh, $review);
// Close the file
fclose($fh);

// Redirect the user back to the Product page
header("Location: " . $_SERVER['HTTP_REFERER'])

?>