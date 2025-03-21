<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $oid = $_GET['oid'];        
            $result = $conn->query("SELECT tb3.AnhSP, tb3.TenSP, tb2.Size, tb1.SoLuong, tb1.Gia FROM ChiTietDH AS tb1 JOIN KhoHang AS tb2 ON tb1.IdKhoHang=tb2.IdKhoHang JOIN SanPham AS tb3 ON tb2.IdSP=tb3.IdSP WHERE IdDonHang=$oid");
            $count = 1;
            $total = 0;
            while($row=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$count?></td>
                    <td><img width="100px" height="80px" src="./uploads/<?=$row['AnhSP']?>"></td>
                    <td><?=$row['TenSP']?></td>
                    <td><?=$row['Size']?></td>
                    <td><?=$row['SoLuong']?></td>
                    <td><?=$row['Gia']?></td>
                </tr>
                <?php
                $count++;
                $total+= ($row['Gia']*$row['SoLuong']);
            }
        ?>
        </tbody>
    </table>
    <p>Tổng tiền: <?=$total?> đ</p>
</div>