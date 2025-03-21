<?php
    session_start();
    include_once "../config/dbconnect.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $uid = $_SESSION['user_id'];
        $fullName = $_POST['fullName'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $payMethod = $_POST['payMethod'];
        $payStatus = "0";
        
        $insertOrder = "INSERT INTO DonHang(IdNguoiDung, TenNguoiNhan, SDT, DiaChi, PhuongThucTT, TrangThaiTT) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare($insertOrder)){
            echo "<script>alert('Lỗi kết nối!')</script>";
            header('Location: ../index.php');
            exit();
        }else{
            $stmt->bind_param("ssssss", $uid, $fullName, $contact, $address, $payMethod, $payStatus);
            if(!$stmt->execute()){
                echo "<script>alert('Xác nhận thất bại!')</script>";
                header("Location: ../index.php");
                exit();
            }else{
                $idOrder=$conn->insert_id;
                $result = $conn->query("SELECT * FROM GioHang JOIN KhoHang ON GioHang.IdKhoHang=KhoHang.IdKhoHang WHERE IdNguoiDung=$uid");
                while($row=$result->fetch_assoc()){
                    $stock = $row['TruLuong'];
                    $quantity = $row['SoLuong'];
                    $ware_id = $row['IdKhoHang'];
                    $price = $row['Gia'];
                    $cart_id = $row['IdGioHang'];
                    $newStock = $stock - $quantity;
                    if($newStock<1){
                        echo "<script>alert('Hàng đã hết!')</script>";
                        header("Location: ../index.php");
                        exit();
                    }else{
                        $stockout=$conn->query("UPDATE KhoHang SET TruLuong=$newStock WHERE IdKhoHang=$ware_id");
                        if($stockout){
                            $conn->query("INSERT INTO ChiTietDH(IdDonHang, IdKhoHang, SoLuong, Gia) VALUES($idOrder, $ware_id, $quantity, $price )");
                            $conn->query("DELETE FROM GioHang WHERE IdGioHang=$cart_id");
                            header("Location: ../order.php?checkout=success");
                        }else{
                            echo $conn->error;
                            echo "<script>alert('Xác nhận thất bại!')</script>";
                            header('Location: ../index.php');
                            exit();
                        }
                    }
                }
            }
        }

    }