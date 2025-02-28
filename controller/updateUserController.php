<?php
    include_once "../config/dbconnect.php";
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        $stmt = $conn->stmt_init();

        // If password is provided, update with password
        if(!empty($password)) {
            $sql = "UPDATE NguoiDung SET TenTK=?, Email=?, MatKhau=?, SDT=?, DiaChi=? WHERE IdNguoiDung=?";
            if(!$stmt->prepare($sql)){
                header("Location:../dashboard.php?error=sqlErr");
                exit();
            }
            $stmt->bind_param("sssssi", $username, $email, $password, $contact, $address, $user_id);
        } 
        // If no password provided, update without password
        else {
            $sql = "UPDATE NguoiDung SET TenTK=?, Email=?, SDT=?, DiaChi=? WHERE IdNguoiDung=?";
            if(!$stmt->prepare($sql)){
                header("Location:../dashboard.php?error=sqlErr");
                exit();
            }
            $stmt->bind_param("ssssi", $username, $email, $contact, $address, $user_id);
        }

        $update = $stmt->execute();
        if(!$update){
            header("Location:../dashboard.php?error=fail");
            exit();
        }else{
            header("Location:../dashboard.php?action=updateUser");
            exit();
        }
    }