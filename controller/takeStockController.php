<?php
    include_once "../config/dbconnect.php";
    $wid = $_POST['id'];
    $result = $conn->query("SELECT TruLuong FROM KhoHang WHERE IdKhoHang='$wid'");
    $ware = $result->fetch_row();
    $stock = $ware[0];
    if($stock>0){
        echo "<span id='stock$wid' data-status='available'>Còn hàng: <span style='color:green'>$stock<span><span>";
    }else{
        echo "<span id='stock$wid' data-status='soldout'style='color:red'>Hết hàng<span>";
    }
    
