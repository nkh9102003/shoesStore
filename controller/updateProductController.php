<?php
    include_once "../config/dbconnect.php";
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $brand = $_POST['brand'];
    $imgName = $_POST['oldImage'];
    if(isset($_FILES['newImage']) && $_FILES['newImage']['size']>0){
        $file = $_FILES['newImage'];
        $ext = strtolower(end(explode(".", $file['name'])));
        $validExt = array("jpeg", "jpg", "png", "webp", "gif");

        if($file["error"]==0){
            if(in_array($ext, $validExt)){
                if($file['size']<2000000){
                    $imgName = uniqid().$file['name'];
                    move_uploaded_file($file['tmp_name'], "../uploads/".$imgName);
                }else{
                    header("Location: ../dashboard.php?error=size");
                    exit();
                }
            }else{
                header("Location: ../dashboard.php?error=ext");
                exit();
            }
        }else{
            header("Location: ../dashboard.php?error=img");
            exit();
        }
    }
    $result=$conn->query("UPDATE SanPham SET TenSP='$name', Gia='$price', Mota='$description', IdThuongHieu='$brand', AnhSP='$imgName' WHERE IdSP='$pid'");
    if($result){
        header("Location: ../dashboard.php?action=updateProduct");
    }else{
        header("Locaiton: ../dashboard.php?error=updateProduct");
    }
