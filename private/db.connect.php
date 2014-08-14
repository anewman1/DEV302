<?php
    $database = 'dev302_shop';
    $hostname = 'localhost';
    $username = 'devadmin';
    $password = 'admin';

    $pdo = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $password);
?>
