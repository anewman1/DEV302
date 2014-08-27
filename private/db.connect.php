<?php
    $database = 'dev302_shop';
    $hostname = 'localhost';
    $username = 'dev302';
    $password = 'dev302';

    $pdo = new PDO("mysql: hostname=$hostname; dbname=$database", $username, $password);
?>
