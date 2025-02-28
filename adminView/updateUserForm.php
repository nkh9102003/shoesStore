<?php
    include_once "../config/dbconnect.php";
    $uid = $_POST['id'];
    $result = $conn->query("SELECT * FROM NguoiDung WHERE IdNguoiDung=$uid");
    $user = $result->fetch_assoc();
?>

<div>
    <form action="./controller/updateUserController.php" method="POST" id="UserForm">
        <input type="hidden" value="<?=$uid?>" name="user_id">
        <div class="form-group">
            <label for="username">Tên tài khoản:</label>
            <input type="text" name="username" id="username" value="<?=$user['TenTK']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?=$user['Email']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Để trống nếu không đổi mật khẩu">
        </div>
        <div class="form-group">
            <label for="contact">Số điện thoại:</label>
            <input type="text" name="contact" id="contact" value="<?=$user['SDT']?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address" value="<?=$user['DiaChi']?>" class="form-control">
        </div>
        <button class="btn btn-secondary" type="button" onclick="showCustomers()">Quay lại</button>
        <input type="submit" class="btn btn-primary" value="Cập nhật">
    </form>
</div>