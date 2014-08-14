<?php
    $database = 'dev302_shop';
    $hostname = 'localhost';
    $username = 'root';
    $password = 'root';

    $pdo = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $password);
?>
