<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$address = $_GET['address'];
$temp = array("api_key"=>"{d427bab9-503b-4daf-8b1e-a18f4bae1f88}","term"=>$term,"max_results"=>5);
$query = http_build_query($temp);
$list = file_get_contents("http://api.addressify.com.au/address/AutoComplete?$query");
echo $getParsedAddress;
