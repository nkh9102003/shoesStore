<?php
    include "../config/dbconnect.php";
    $wid = $_POST['id'];
    $conn->query("DELETE FROM KhoHang WHERE IdKhoHang=$wid");
    echo $conn->error;