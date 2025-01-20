<?php
$db_name = "mysql:host=localhost;dbname=pharmacy_db;charset=utf8";
$username ="root";
$password = "";

try {
    $conn = new PDO($db_name , $username , $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed" . $e->getMessage());
   
}


?>
