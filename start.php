<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "ava");
// password is 

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
?>