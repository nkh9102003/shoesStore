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
        include_once "./config/dbconnect.php";
    ?>
    <div class="allContent-section container">
        <div class="cart-account card-container text-center">
            <?php
                if(isset($_GET['checkout'])){
                    if($_GET['checkout']=="success"){
                        echo "<h3>Đặt hàng thành công</h3><hr>";
                        echo "<img id='profile-img' class='profile-img-card' src='./assets/images/accept.png'>";
                        echo "<p id='profile-name' class='profile-name-card'>Đơn hàng của bạn đã được xác nhận</p>";
                    }else{
                        echo "<h3>Đặt hàng thất bại</h3>";
                        echo "<img id='profile-img' class='profile-img-card' src='./assets/images/reject.png'>";
                    }
                }
            ?>
        </div>
        <div class="container py-4">
            <h2>Lịch sử đơn hàng</h2>
            <?php
                if(isset($_SESSION['user_id'])){
                    $uid = $_SESSION['user_id'];
                    $result=$conn->query("SELECT * FROM DonHang WHERE IdNguoiDung=$uid");
                    if($result->num_rows>0){
                        while($order=$result->fetch_assoc()){
                            $order_id = $order['IdDonHang'];
                            ?>
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-9">
                                        <label>#<?=$order_id?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Ngày đặt: <?=$order['NgayDat']?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Tên: <?=$order['TenNguoiNhan']?></label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Số điện thoại: <?=$order['SDT']?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Địa chỉ: <?=$order['DiaChi']?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Phương thức thanh toán: <?=$order['PhuongThucTT']?></label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Trạng thái thanh toán: 
                                            <?=($order['TrangThaiTT']=="0") ? "<label style='color:red'>Chưa thanh toán</label>" : "<label style='color:green'>Đã thanh toán</label>" ?>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Trạng thái giao hàng: 
                                            <?=($order['TrangThaiDH']=="0") ? "<label style='color:red'>Đang chờ</label>" : "<label style='color:grey'>Đã giao</label>"?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                    $result1 = $conn->query("SELECT * FROM ChiTietDH WHERE IdDonHang=$order_id");
                                    while($detail=$result1->fetch_assoc()){
                                        $takeProduct = $conn->query("SELECT * FROM SanPham JOIN KhoHang ON SanPham.IdSP=KhoHang.IdSP WHERE IdKhoHang='".$detail['IdKhoHang']."'");
                                        $product = $takeProduct->fetch_assoc();
                                        ?>
                                        <hr><div class="row">
                                            <div class="col-md-4">
                                                <img src="./uploads/<?=$product['AnhSP']?>" height="100">
                                            </div>
                                            <div class="col-md-2">
                                                <label><?=$product['TenSP']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Size: <?=$product['Size']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Số lượng: <?=$detail['SoLuong']?></label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Giá: <?=$detail['Gia']?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="card-account card-container text-center mt-5 mb-5 py-4">
                            Lịch sử đơn hàng trống!!
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="card-account card-container text-center mt-5 mb-5 py-4">
                        Vui lòng đăng nhập để xem lịch sử đơn hàng!!
                        <div class="card-login-btn">
                            <a href="./login.php" class="btn btn-success">Đăng nhập</a>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>









    <?php
        include "./footer.php";
    ?>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>
</html>