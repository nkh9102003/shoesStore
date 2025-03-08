<?php
    session_start();
    include_once "../config/dbconnect.php";
    $cart_id = $_POST['id'];
    $result = $conn->query("SELECT * FROM GioHang WHERE IdGioHang='".$cart_id."'");
    $cart = $result->fetch_assoc();
    $quantity = $cart['SoLuong'];
    $ware_id = $cart['IdKhoHang'];
    $result1 = $conn->query("SELECT TruLuong FROM KhoHang WHERE IdKhoHang=$ware_id");
    $ware = $result1->fetch_assoc();
    $stock = $ware['TruLuong'];
    if($stock-$quantity>1){
        $quantity++;
        $conn->query("UPDATE GioHang SET SoLuong=$quantity WHERE IdGioHang=$cart_id");
    }else{
        echo '<script>alert("Hàng đã hết!")</script>';
    }

