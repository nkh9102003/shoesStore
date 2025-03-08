<?php
    include_once "../config/dbconnect.php";
    $wid=$_POST['so_ware_id'];
    $quantity=$_POST['soQuantity'];
    $conn->query("UPDATE KhoHang SET TruLuong=(TruLuong-$quantity) WHERE IdKhoHang=$wid");