<?php
    include_once "../config/dbconnect.php";
    $cart_id = $_POST['id'];
    $result = $conn->query("SELECT * FROM GioHang WHERE IdGioHang=$cart_id");
    $cart = $result->fetch_assoc();
    $quantity = $cart['SoLuong'];
    if($quantity>1){
        $quantity--;
        $conn->query("UPDATE GioHang SET SoLuong=$quantity WHERE IdGioHang=$cart_id");
    }
    echo $cart_id."soluong".$quantity;
    
    