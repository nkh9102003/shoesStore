<?php
    include_once "../config/dbconnect.php";
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];
        $image = $_FILES['image'];

        $imgName = $image['name'];
        $imgTemp = $image['tmp_name'];
        $imgSize = $image['size'];
        $imgError = $image['error'];
        $ext = strtolower(end(explode(".", $imgName)));
        $validExt = array("jpeg", "jpg", "png", "gif", "webp");
        if($imgError==0){
            if(in_array($ext, $validExt)){
                if($imgSize<2000000){
                    $imgNewName = uniqid().$imgName;
                    move_uploaded_file($imgTemp, "../uploads/".$imgNewName);
                    $result=$conn->query("INSERT INTO SanPham (TenSP, Gia, MoTa, IdThuongHieu, AnhSP) VALUES ('$name','$price','$description','$brand','$imgNewName')");
                    if($result){
                        header("Location: ../dashboard.php?action=addProduct");
                    }else{
                        header("Location: ../dashboard.php?error=addProduct");
                    }
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
