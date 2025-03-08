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
    <div class="user-cart">
        <a <?=isset($_SESSION['user_id']) ? "onclick=\"loadDoc('./view/viewMyCart.php',loadAllContent)\"" : "href='./login.php'"?>>
            <i class="fa-regular fa-cart-shopping mr-sm-3" aria-hidden="true" style="font-size:30px; color: #fff; position:relative">
                <span class="count">
                    <?php
                        if(isset($_SESSION["user_id"])){
                            $result = mysqli_query($conn, "SELECT * FROM GioHang WHERE IdNguoiDung='".$_SESSION['user_id']."'");
                            echo mysqli_num_rows($result);
                        }else{
                            echo 0;
                        }
                    ?>
                </span>
            </i>
        </a>
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

