<?php
    include "../config/dbconnect.php";
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $address = $_POST["address"];
        $contact = $_POST["contact"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location:../register.php?error=invalidMail");
            exit();
        }else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location:../register.php?error=invalidUn");
            exit();
        }else if($confirm_password !== $password){
            header("Location:../register.php?error=incorrectRepwd");
            exit();
        }
        $sql = "SELECT * FROM NguoiDung WHERE TenTK=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:../register.php?error=sqlErr1");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)>0){
            header("Location:../register.php?error=unExist");
            exit();
        }
        mysqli_stmt_reset($stmt);
        $sql = "SELECT * FROM NguoiDung WHERE Email=?";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:../register.php?error=sqlErr2");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)>0){
            header("Location:../register.php?error=emExist");
            exit();
        }
        mysqli_stmt_reset($stmt);
        $sql = "INSERT INTO NguoiDung (TenTK, Email, MatKhau, SDT, DiaChi) VALUES (?, ?, ?, ?, ?)";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:../register.php?error=sqlErr3");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $password, $contact, $address);
        mysqli_stmt_execute($stmt);        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location:../login.php?signup=success");
    }else{
        header("Location:../login.php");
    }
