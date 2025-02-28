<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/all.css">
    <script src="./assets/js/script.js"></script>
 
    <style>
        .background {
            
            min-height: 90vh;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include "./header.php";
    
    ?>

    <div class="allContent-section" id="main-content">
        <div class="background">
            <div class="carousel-container">
                <div class="carousel slide" id="image-carousel" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#image-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#image-carousel" data-slide-to="1"></li>
                        <li data-target="#image-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/images/banner1.jpeg" alt="" class="d-block w-100">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/banner2.png" alt="" class="d-block w-100">
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/banner3.jpeg" alt="" class="d-block w-100">
                            <div class="carousel-caption"></div>
                        </div>
                    </div>
                    <a href="#image-carousel" class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only"></span>
                    </a>
                    <a href="#image-carousel" class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "sqlErr"){
                echo "<script>showNot('failed', 'Lỗi kết nối')</script>";
                echo '<script>showMyProfile()</script>';
            }
        }else if (isset($_GET['update'])){
            if($_GET['update'] == "success") {
                echo '<script>showNot("succeeded", "Cập nhật thành công")</script>';
                echo '<script>showMyProfile()</script>';
            }elseif (isset($_GET['update']) && $_GET['update'] == "fail") {
                echo '<script>showNot("failed", "Cập nhật thất bại")</script>';
                echo '<script>showMyProfile()</script>';
            }
        }else if (isset($_GET['login'])){
            if($_GET['login'] == "success"){
                echo '<script>showNot("succeeded", "Đăng nhập thành công")</script>';
            }
        }


        include "./footer.php";
    ?>
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>
</html>