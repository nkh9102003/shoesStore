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
        .product-card{
            min-height: 300px;
        }
    </style>
</head>
<body>
    <?php
        include_once "./header.php";
        include_once "./config/dbconnect.php";

        $selectProduct = "SELECT * FROM SanPham";
        $selectedProduct = mysqli_query($conn, $selectProduct);
    ?>

    <div id="main-content" class="allContent-section container">
        <div class="container-fluid px5" >
            <div class="row px-5 py-4 productList">
            <?php
            $selectedProduct = mysqli_query($conn, $selectProduct);
                while($row = mysqli_fetch_array($selectedProduct)){
                    ?>
                    <div class="col-sm-4">
                        <div class="card product-card">
                            <div class="box">
                                <img src="./uploads/<?=$row['AnhSP']?>" class="image">
                                <div class="middle">
                                    <div class="text" onclick="showEachProduct('<?=$row['IdSP']?>')">Xem chi tiết</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" title="<?=$row['TenSP']?>" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; "><?=$row['TenSP']?></h5>
                                <p style="color: green">đ. <?=$row['Gia']?></p>
                                <p class="card-text">
                                    <form id="addToCartForm<?=$row['IdSP']?>" method="post">
                                        <div class="form-group">
                                            <label for="size<?=$row['IdSP']?>">Size</label>
                                            <select id="size<?=$row['IdSP']?>" name="size" onchange="checkStock(<?=$row['IdSP']?>)">
                                                <option disabled selected value="empty">Chọn size</option>
                                                <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM KhoHang WHERE IdSP='".$row['IdSP']."'");
                                                    while($sizeRow=mysqli_fetch_assoc($result)){
                                                        echo "<option value='".$sizeRow['IdKhoHang']."'>".$sizeRow['Size']."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <p id="stock<?=$row['IdSP']?>" style="min-height:30px;"></p>
                                            <input type="hidden" name="pid" value="<?=$row['IdSP']?>">
                                        </div>
                                        <?php
                                            if(isset($_SESSION['user_id'])){
                                                ?>
                                                <button id="addToCartBtn<?=$row['IdSP']?>" type="button" onclick="validateForm(<?=$row['IdSP']?>)" class="btn btn-success" name="addToCart">Thêm vào giỏ hàng</button>
                                                <?php
                                            }else{
                                                ?>
                                                <button id="addToCartBtn<?=$row['IdSP']?>" type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Thêm vào giỏ hàng</button>
                                                <?php
                                            }
                                        ?>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đăng nhập</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="form-signin" action="./controller/loginValidateController.php" method="post">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="text" name="usernameEmail" class="form-control" placeholder="Tên đăng nhập /Email" required autofocus>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login-submit">Đăng nhập</button>
                    </form>
                    <p>Không có tài khoản? <a href="./register.php">Đăng ký</a></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Đóng</button>                    
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once "./footer.php";
    ?>
    <script>
        function validateForm(id){
            var size = document.getElementById('size'+id).value;
            if(size === "empty"){
                showNot("warning", "Vui lòng chọn size!");
            }else{
                addToCart(id);
            }
            
        }
    </script>

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    
</body>
</html>