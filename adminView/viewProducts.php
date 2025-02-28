<div>
    <h2>Quản lý sản phẩm</h2>
    <button class="btn btn-success" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>
    <table class="table">
        <thead>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Thương hiệu</th>
            <th>Giá</th>
            <th colspan="2"></th>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $result=$conn->query("SELECT * FROM SanPham ORDER BY IdSP DESC");
            $count=1;
            while($product=$result->fetch_assoc()){
                $result1=$conn->query("SELECT * FROM ThuongHieu WHERE IdThuongHieu='".$product['IdThuongHieu']."'");
                $brand=$result1->fetch_assoc();
                ?>
                <tr>
                    <td><?=$count?></td>
                    <td><img width="150px" height="100px" src="./uploads/<?=$product['AnhSP']?>"</td>
                    <td><?=$product['TenSP']?></td>
                    <td><?=$product['MoTa']?></td>
                    <td><?=$brand['ThuongHieu']?></td>
                    <td><?=$product['Gia']?></td>
                    <td><button class="btn btn-primary" onclick="showProductForm(<?=$product['IdSP']?>)">Sửa</button></td>
                    <td><button class="btn btn-danger" onclick="deleteProduct(<?=$product['IdSP']?>)">Xoá</button></td>
                </tr>
                <?php
                $count++;
            }   
        ?>
        </tbody>
    </table>
    <div class="modal fade" id="addProductModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Sản phẩm mới</div>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="./controller/addProductController.php" id="ProductForm" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="name">Tên sản phẩm:</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Giá:</label>
                            <input class="form-control" type="text" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả:</label>
                            <input class="form-control" type="text" name="description" id="description"> 
                        </div>
                        <div class="form-group">
                            <label for="brand">Thương hiệu:</label>
                            <select name="brand" id="brand">
                                <option selected value="0">Chọn thương hiệu</option>
                            <?php
                                $result=$conn->query("SELECT * FROM ThuongHieu");
                                while($brand=$result->fetch_assoc()){
                                    ?>
                                    <option value="<?=$brand['IdThuongHieu']?>"><?=$brand['ThuongHieu']?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Chọn hình ảnh:</label>
                            <input name="image" id="image" type="file">
                        </div>
                        <input type="button" onclick=validateProduct() class="btn btn-success" value="Thêm" name="addProduct">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

