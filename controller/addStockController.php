<?php
    include_once "../config/dbconnect.php";
    $pid = $_POST['pid'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $result = $conn->query("SELECT IdKhoHang FROM KhoHang WHERE IdSP=$pid AND `Size`='$size'");
    if($result->num_rows>0){
        $ware = $result->fetch_row();
        $wid = $ware[0];
        $conn->query("UPDATE KhoHang SET TruLuong=(TruLuong+$quantity) WHERE IdKhoHang=$wid");
    }else{
        $conn->query("INSERT INTO KhoHang (IdSP, `Size`, TruLuong ) VALUES ('$pid', '$size', '$quantity')");
    }
