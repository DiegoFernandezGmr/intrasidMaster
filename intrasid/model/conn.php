<?php
//$dsn = "mysql:host=localhost;dbname=tasklist";
//$user = "root";
//$pass = "lukysol"; //reemplazar por la que corresponda
/*$dsn = "mysql:host=localhost;dbname=tasklist";
$user = "root"; //
$pass = "mysql"; //reemplazar por la que corresponda 
$db = new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


*/
    $db = new PDO('mysql:host=localhost;dbname=tasklist', "root", "mysql");
    if (!$db) 
    {
        die('No pudo conectarse: ' . $db->errorInfo());
    }
?>