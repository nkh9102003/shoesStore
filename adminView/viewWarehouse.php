<div>
    <h2>Quản lý kho hàng</h2>
    <button class="btn btn-success" data-toggle="modal" data-target="#newStockModal">Nhập hàng mới</button>
    <table class="table">
        <thead>
            <tr class="align-middle">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Size</th>
                <th>Trữ lượng</th>
                <th ></th>
            </tr>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $result = $conn->query("SELECT * FROM SanPham JOIN KhoHang ON SanPham.IdSP=KhoHang.IdSP ORDER BY KhoHang.IdSP DESC");
            $count = 1;
            while($row=$result->fetch_assoc()){
                ?>
                <tr class="align-middle">
                    <td class="align-middle"><?=$count?></td>
                    <td><?=$row['TenSP']?></td>
                    <td><img src="./uploads/<?=$row['AnhSP']?>" width="150px" height="100px"></td>
                    <td><?=$row['Size']?></td>
                    <td>
                        <button class="btn btn-danger mr-3" style="font-size:large" data-toggle="modal" data-target="#stockOutModal" onclick="setSOForm(<?=$row['IdKhoHang']?>)">-</button>
                        <?=$row['TruLuong']?>
                        <button class="btn btn-success ml-3" style="font-size:large" data-toggle="modal" data-target="#stockInModal" onclick="setSIForm(<?=$row['IdKhoHang']?>)">+</button></td>
                    <td><button class="btn btn-primary" onclick="deleteStock(<?=$row['IdKhoHang']?>)">Xoá</button></td>
                </tr>
                <?php
                $count++;
            }        
        ?>
        </tbody>
    </table>

    <div class="modal fade" id="stockInModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nhập thêm</h4>
                    <button data-dismiss="modal" class="btn btn-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" id="stockInForm">
                        <input type="hidden" id="si_ware_id" name="si_ware_id" value="">
                        <input type="hidden" id="pid" name="pid" value="">
                        <div class="form-group">
                            <label for="siQuantity">Số lượng nhập: </label>
                            <input type="number" id="siQuantity" name="siQuantity" class="form-control">
                        </div>
                        <button class="btn btn-success" type="button" data-dismiss="modal" onclick="stockIn()">Nhập</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-close">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stockOutModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bớt trữ lượng</h4>
                    <button data-dismiss="modal" class=" btn btn-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" id="stockOutForm">
                        <input type="hidden" id="so_ware_id" name="so_ware_id" value="">
                        <input type="hidden" id="oldQuantity" value="">
                        <div class="form-group">
                            <label for="soQuantity">Số lượng bớt:</label>
                            <input type="number" class="form-control" name="soQuantity" id="soQuantity">
                        </div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="stockOut()">Cập nhật</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-close" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newStockModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nhập hàng:</h4>
                    <button class="btn btn-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" id="newStockForm">
                        <div class="form-group">
                            <label for="pid">Chọn sản phẩm</label>
                            <select id="productId" name="pid" class="form-control">
                                <option selected value="0">Chọn sản phẩm</option>
                            <?php
                            $result=$conn->query("SELECT * FROM SanPham ORDER BY IdSP DESC");
                            while($product=$result->fetch_assoc()){
                                ?>
                                <option value="<?=$product['IdSP']?>"><?=$product['TenSP']?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Size:</label>
                            <input type="text" class="form-control" name="size" id="size">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng nhập: </label>
                            <input type="text" id="quantity" name="quantity" class="form-control">
                        </div>
                        <button class="btn btn-success" type="button" onclick="newStock()">Nhập hàng</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-close" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
