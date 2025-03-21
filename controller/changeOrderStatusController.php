<?php
    include_once "../config/dbconnect.php";
    $oid = $_POST['id'];
    $result = $conn->query("SELECT * FROM DonHang WHERE IdDonHang=$oid");
    if($result->num_rows>0){
        $order = $result->fetch_assoc();
        if($order['TrangThaiDH']==0){
            $conn->query("UPDATE DonHang SET TrangThaiDH=1 WHERE IdDonHang=$oid");
        }else{
            $conn->query("UPDATE DonHang SET TrangThaiDH=0 WHERE IdDonHang=$oid");
        }
    }
    
