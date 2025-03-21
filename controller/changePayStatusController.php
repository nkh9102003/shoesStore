<?php
    include_once "../config/dbconnect.php";
    $oid = $_POST['id'];
    $result = $conn->query("SELECT * FROM DonHang WHERE IdDonHang=$oid");
    if($result->num_rows>0){
        $order = $result->fetch_assoc();
        if($order['TrangThaiTT']==0){
            $conn->query("UPDATE DonHang SET TrangThaiTT=1 WHERE IdDonHang=$oid");
        }else{
            $conn->query("UPDATE DonHang SET TrangThaiTT=0 WHERE IdDonHang=$oid");
        }
    }
    