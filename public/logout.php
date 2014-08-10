<?php

    // START SESSION and set VARIABLES
    session_start();
    $page = $_SERVER['HTTP_REFERER'];
    
    // IF LOGGED IN, REMOVE DETAILS
    session_destroy();

    // FUNCTION TO CHANGE PAGE
    function redirect($url)
        {
            header("Location: $url");
            die();
        }

    // REDIRECT TO PAGE USER WAS ON
    redirect($page);
