<div>
    <h2>Danh sách đơn hàng</h2>
    <table class="table table-striped">
        <thead>
            <th>STT</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
            <th>Ngày đặt</th>
            <th>Phương thức thanh toán</th>
            <th>Trang thái giao hàng</th>
            <th>Trạng thái thanh toán</th>
            <th>Chi tiết</th>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $result = $conn->query("SELECT * FROM DonHang ORDER BY NgayDat DESC");
            $count=1;
            while($order=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$count?></td>
                    <td><?=$order['TenNguoiNhan']?></td>
                    <td><?=$order['SDT']?></td>
                    <td><?=$order['NgayDat']?></td>
                    <td><?=$order['PhuongThucTT']?></td>
                    <td>
                    <?php
                        if($order['TrangThaiDH']==0){
                        ?>
                        <button class="btn btn-danger" onclick="changeOrderStatus(<?=$order['IdDonHang']?>)">Đang chờ</button>             
                        <?php
                        }else{
                        ?>
                        <button class="btn btn-success" onclick="changeOrderStatus(<?=$order['IdDonHang']?>)">Đã giao</button>
                        <?php
                        }
                    ?>
                    </td>
                    <td>
                    <?php
                        if($order['TrangThaiTT']==0){
                        ?>
                        <button class="btn btn-danger" onclick="changePayStatus(<?=$order['IdDonHang']?>)">Chưa thanh toán</button>    
                        <?php
                        }else{
                        ?>
                        <button class="btn btn-success" onclick="changePayStatus(<?=$order['IdDonHang']?>)">Đã thanh toán</button>
                        <?php
                        }
                    ?>
                    </td>
                    <td><a class="btn btn-primary" id="openDetailBtn<?=$order['IdDonHang']?>" data-href="./adminView/viewOrderDetails.php?oid=<?=$order['IdDonHang']?>" onclick="showOrderDetail(<?=$order['IdDonHang']?>)">Xem</a></td>
                </tr>
                <?php
                $count++;
            }
        ?>
        </tbody>
    </table>
    <div class="modal fade" id="orderDetailModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="orderDetail"></div>
            </div>
        </div>
    </div>
</div>

