<?php

//MySQLi OOP
$conn = new mysqli("localhost","root","","sum");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
?>