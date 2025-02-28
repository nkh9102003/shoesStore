<div>
    <h2>Quản lý khách hàng</h2>
    <button class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Thêm tài khoản</button>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên tài khoản</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th colspan=2></th>
            </tr>
        </thead>
        <tbody>
        <?php
            include_once "../config/dbconnect.php";
            $result = $conn->query("SELECT * FROM NguoiDung WHERE QuyenQuanTri=0");
            $count=1;
            while($user=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$count?></td>
                    <td><?=$user['TenTK']?></td>
                    <td><?=$user['Email']?></td>
                    <td><?=$user['SDT']?></td>
                    <td><?=$user['DiaChi']?></td>
                    <td><button class="btn btn-primary" onclick="showUserForm(<?=$user['IdNguoiDung']?>)">Sửa</button></td>
                    <td><button class="btn btn-danger" onclick="deleteUser(<?=$user['IdNguoiDung']?>)">Xoá</button></td>
                </tr>
                <?php
                $count++;
            }
        ?>
        </tbody>
    </table>
    <div id="addUserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm tài khoản</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="./controller/addUserController.php" method="POST" class="form-signin" id="addUserForm">
                        <input class="form-control" name="username" id="username" type="text" placeholder="Tên tài khoản..." >
                        <input class="form-control" name="email" id="email" type="text" placeholder="Email..." >
                        <input class="form-control" name="password" id="password" type="password" placeholder="Mật khẩu..." >
                        <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="Nhập lại mật khẩu..." >
                        <input class="form-control" name="address" id="address" type="text" placeholder="Địa chỉ..." >
                        <input class="form-control" name="contact" id="contact" type="text" placeholder="Số điện thoại..." >
                        <input class="btn btn-success" type="button" onclick=validateAddUser() value="Thêm">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
