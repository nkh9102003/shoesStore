<?php
    include_once "../config/dbconnect.php";
    $wid = $_POST['si_ware_id'];
    $pid = $_POST['pid'];
    $quantity = $_POST['siQuantity'];
    $result = $conn->query("SELECT * FROM KhoHang WHERE IdKhoHang=$wid");
    $ware = $result->fetch_assoc();
    $newQuantity = $ware['TruLuong'] + $quantity;
    $conn->query("UPDATE KhoHang SET TruLuong=$newQuantity WHERE IdKhoHang=$wid");