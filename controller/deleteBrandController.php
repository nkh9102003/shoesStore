<?php
    include_once "../config/dbconnect.php";
    $bid = $_POST['id'];
    $result = $conn->query("DELETE FROM ThuongHieu WHERE IdThuongHieu='$bid'");