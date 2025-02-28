<?php

require "../config/dbconnect.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $usernameEmail = $_POST['usernameEmail'];
    $password = $_POST['password'];
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * FROM NguoiDung WHERE TenTK=? OR Email=?";
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../login.php?error=sqlErr");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $usernameEmail, $usernameEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($user=mysqli_fetch_assoc($result)){
        if($password==$user['MatKhau']){
            $_SESSION['isAdmin'] = $user['QuyenQuanTri'];
            $_SESSION['user_id'] = $user['IdNguoiDung'];
            $_SESSION['username'] = $user['TenTK'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['contact_num'] = $user['SDT'];
            $_SESSION['address'] = $user['DiaChi'];
            if($_SESSION['isAdmin'] == 0){
                header("Location:../index.php?login=success");
                exit();
            }else{
                header("Location:../dashboard.php?login=success");
                exit();
            }
        }else{
            header("Location:../login.php?error=wrongpassword");
            exit();
        }
    }else{
        header("Location:../login.php?error=nouser");
        exit();
    }
}