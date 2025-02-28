<?php
    include_once "../config/dbconnect.php";
    $pid = $_POST['id'];
    $result2 = $conn->query("DELETE FROM SanPham WHERE IdSP=$pid");
    