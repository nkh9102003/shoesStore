<?php
    include_once "../config/dbconnect.php";
    $brand = $_POST['brand'];
    $result = $conn->query("INSERT INTO ThuongHieu (ThuongHieu) VALUES ('$brand')");
