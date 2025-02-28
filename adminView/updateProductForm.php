<?php
    include_once "../config/dbconnect.php";
    $pid = $_POST['id'];
    $result = $conn->query("SELECT * FROM SanPham WHERE IdSP=$pid");
    $product= $result->fetch_assoc();
?>

<div>
    <form action="./controller/updateProductController.php" method="POST" enctype="multipart/form-data" id="ProductForm">
        <input type="hidden" value="<?=$pid?>" name="pid">
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" value="<?=$product['TenSP']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" name="price" id="price" value="<?=$product['Gia']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <input type="text" name="description" id="description" value="<?=$product['MoTa']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="brand">Thương hiệu:</label>
            <select name="brand" id="brand">
                <option value="0">Chọn thương hiệu</option>
            <?php
                $result=$conn->query("SELECT * FROM ThuongHieu");
                while($brand=$result->fetch_assoc()){
                    ?>
                    <option value="<?=$brand['IdThuongHieu']?>" <?php if($brand['IdThuongHieu']==$product['IdThuongHieu']) echo "selected"?>><?=$brand['ThuongHieu']?></option>
                    <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <img src="./uploads/<?=$product['AnhSP']?>" width="200px" height="150px">
            <div class="mt-2">
                <label for="newImage">Hình ảnh</label>
                <input type="text" name="oldImage" class="form-control" value="<?=$product['AnhSP']?>" hidden>
                <input type="file" id="newImage" name="newImage">
            </div>
        </div>
        <button class="btn btn-secondary" type="button" onclick="showProducts()">Quay lại</button>
        <input type="button" onclick="validateProduct()" class="btn btn-primary" name="updateProduct" value="Cập nhật"></input>
    </form>
</div>