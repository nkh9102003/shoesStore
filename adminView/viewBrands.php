<div>
    <h3>Thương hiệu sản phẩm</h3>
    <button class="btn btn-success" data-toggle="modal" data-target="#addBrandForm">Thêm hiệu giày</button>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thương hiệu</th>
                <th colspan="2" style="width:20%"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $result = $conn->query("SELECT * FROM ThuongHieu ORDER BY IdThuongHieu DESC");
            $count=1;
            while($brand=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$count?></td>
                    <td id="tdBrand<?=$brand['IdThuongHieu']?>"><?=$brand['ThuongHieu']?></td>
                    <td><button class="btn btn-primary" id="editButton<?=$brand['IdThuongHieu']?>" onclick="editBrand(<?=$brand['IdThuongHieu']?>)">Sửa</button></td>
                    <td><button class="btn btn-danger" id="deleteButton<?=$brand['IdThuongHieu']?>" onclick="deleteBrand(<?=$brand['IdThuongHieu']?>)">Xoá</button></td>
                </tr>
                <?php
                $count++;
            }
        ?>
        </tbody>
    </table>
    <div class="modal fade" id="addBrandForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-tittle">Thêm thương hiệu</h4>
                    <button class="btn" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="brand">Tên thương hiệu</label>
                            <input type="text" id="brand" name="brand" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" onclick="addBrand()" data-dismiss="modal">Thêm</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Huỷ</button>
                </div>
            </div>
        </div>
    </div>
</div>