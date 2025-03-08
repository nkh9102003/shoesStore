<div class="container py-4 position-relative">
<?php
    include_once "../config/dbconnect.php";
    session_start();
    $result = mysqli_query($conn, "SELECT * FROM GioHang JOIN KhoHang ON GioHang.IdKhoHang=KhoHang.idKhoHang JOIN SanPham ON KhoHang.IdSP=SanPham.IdSP WHERE IdNguoiDung='".$_SESSION['user_id']."'");
    if(mysqli_num_rows($result)==0){
        ?>
        <div class="card-account card-container text-center mt-5 mb-5 py-4">Giỏ hàng trống</div>
        <?php
    }else{
        ?>
        <h2>Giỏ hàng</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
        <?php
        $count=1;
        $total=0;
        while($row=mysqli_fetch_array($result)){
            ?>
            
            <tr>
                <td><?=$count?></td>
                <td><img src="./uploads/<?=$row['AnhSP']?>" width="150px" height="100px" ></td>
                <td><?=$row['TenSP']?></td>
                <td><?=$row['Size']?></td>
                <td>
                    <button class="btn btn-default" onclick="subtractQuantity('<?=$row['IdGioHang']?>')">
                        <i class="fa-solid fa-minus fa-xl" aria-hidden="true"></i>
                    </button>
                    <?=$row['SoLuong']?>
                    <button class="btn btn-default" onclick="addQuantity('<?=$row['IdGioHang']?>')">
                        <i class="fa-solid fa-plus fa-xl" aria-hidden="true"></i>
                    </button>
      
                </td>
                <td><?=$row['Gia']?></td>
                <td>
                    <button class="btn btn-danger" onclick="deleteFromCart('<?=$row['IdGioHang']?>')" style="height:40px">Xoá</button>
                </td>
            </tr>
            <?php
            $count++;
            $total+=($row['Gia']*$row['SoLuong']);
        }
            ?>
            </tbody>
        </table>
        <div class="mb-3">Tổng tiền: <?=$total?> đ</div>
        <a href="./product.php" class="btn btn-success mb-4" style="height:40px;">Tiếp tục xem hàng</a>
        <button class="btn btn-success mb-4 position-absolute" style="height:40px; right:15px;" onclick="checkout()">Xác nhận đơn hàng</button>
            <?php
    }
    

?>
</div>
<script>
    var error = document.getElementById('error').value;
    if(error=='exist'){
        alert("Mặt hàng này đã có trong giỏ hàng!");
    }
</script>