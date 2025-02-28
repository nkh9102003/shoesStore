<?php
    include_once "../config/dbconnect.php";
    $uid = $_POST['id'];
    $result=$conn->query("DELETE FROM NguoiDung WHERE IdNguoiDung=$uid");
    echo $conn->error;