<?php
    include_once "../config/dbconnect.php";
    $newBrand = $_POST['newBrand'];
    $bid = $_POST['id'];
    $result = $conn->query("UPDATE ThuongHieu SET ThuongHieu='$newBrand' WHERE IdThuongHieu='$bid'");