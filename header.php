<?php
    if (session_status() == PHP_SESSION_NONE)   session_start();
    include_once "./config/dbconnect.php";

    $currentPage = basename($_SERVER["PHP_SELF"]);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-black" style="padding:0; background-color: black">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggle-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a href="./index.php" class="nav-item nav-link <?php if($currentPage == "index.php")   echo "active";?>" >Trang chủ</a>
            <a href="./product.php" class="nav-item nav-link <?php if($currentPage == "product.php")   echo "active";?>" >Sản phẩm</a>
        </div>
    </div>
    
    <?php
        if(isset($_SESSION['user_id'])){
            ?>
            <a class="text-light nav-right" onclick="loadDoc('./view/viewMyProfile.php',loadAllContent)">Xin chào, <?= $_SESSION['username'];?></a>
            <a class="text-light nav-right" href="./logout.php">Đăng xuất</a>
            <?php
        }else{
            ?>
            <a class="text-light nav-right" href="./login.php">Đăng nhập</a>
            <a class="text-light nav-right" href="./register.php">Đăng ký</a>
            <?php
        }
    ?>

</nav>
<div class="not-container"></div>

