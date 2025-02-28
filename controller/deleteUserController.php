<?php
    include_once "../config/dbconnect.php";
    $uid = $_POST['id'];
    $conn->query("DELETE tb1.* FROM ChiTietDH AS tb1 JOIN DonHang AS tb2 ON tb1.IdDonHang=tb2.IdDonHang WHERE tb2.IdNguoiDung=$uid");
    $conn->query("DELETE tb1.*, tb2.*, tb3.* FROM DonHang AS tb1 LEFT JOIN GioHang AS tb2 ON tb1.IdNguoiDung=tb2.IdNguoiDung LEFT JOIN DanhGia AS tb3 ON tb1.IdNguoiDung=tb3.IdNguoiDung WHERE tb1.IdNguoiDung=$uid");
    $result=$conn->query("DELETE FROM NguoiDung WHERE IdNguoiDung=$uid");
    echo $conn->error;