<?php
    session_start();
    include_once "../config/dbconnect.php";
    $ware_id = $_POST['ware_id'];
    $sql = "INSERT INTO Giohang(IdNguoiDung, SoLuong, IdKhoHang) VALUES (".$_SESSION['user_id'].", 1, $ware_id)";
    $query = $conn->query($sql);
    if(!$query && $conn->errno==1062){
        echo "<div id='error' value='exist' ></div>";
    }else{
        echo "<div id='error' value='none' ></div>";
    }
