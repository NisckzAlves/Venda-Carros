<?php
require("config.php");
$dsn = "mysql:host=$servername;dbname=$dbname;charset=UTF8";

$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
?>