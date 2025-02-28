<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "shoes";

$conn = new mysqli($server, $user, $password, $db);

if(!$conn){
    die("Kết nối thất bại:".mysqli_connect_error());
}