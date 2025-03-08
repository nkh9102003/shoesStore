<?php
    include_once "../config/dbconnect.php";
    $cart_id = $_POST['id'];
    $conn->query("DELETE FROM GioHang WHERE IdGioHang='".$cart_id."'");