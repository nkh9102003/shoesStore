<?php
    include_once "../config/dbconnect.php";
    $pid = $_POST['id'];
    $result = $conn->query("DELETE tb2.* , tb3.* FROM KhoHang AS tb1 LEFT JOIN ChiTietDH AS tb2 ON tb1.IdKhoHang=tb2.IdKhoHang LEFT JOIN Giohang AS tb3 ON tb1.IdKhoHang=tb3.IdKhoHang WHERE tb1.IdSP=$pid");
    $result1 = $conn->query("DELETE tb2.*, tb3.* FROM SanPham AS tb1 LEFT JOIN KhoHang AS tb2 ON tb1.IdSP=tb2.IdSP LEFT JOIN DanhGia AS tb3 ON tb1.IdSP=tb3.IdSP WHERE tb1.IdSP=$pid");
    $result2 = $conn->query("DELETE FROM SanPham WHERE IdSP=$pid");
    