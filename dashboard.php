<?php
    session_start();
    include_once "./config/dbconnect.php";


    if(!isset($_SESSION['user_id'])||$_SESSION['isAdmin']==0){
        header("Location: ./login.php?error=noadmin");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/all.css">
    <script src="./assets/js/ajaxWork.js"></script>
    <script src="./assets/js/script.js"></script>

    <style>
        #main-content{
            margin-left: 100px;
        }
        .card{
            background-color: #99C93F;
        }
        .chartBox{
            width: 100%;
        }
    </style>
</head>
<body>
    <?php
        include "./sidebar.php"
    ?>
    <div class="not-container">
        
    </div>
    <div id="main-content" class="container allContent-section">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <img src="./assets/images/customers.jpg" width="50px" height="50px">
                    <h4 class="text-white">Lượng khách hàng</h4>
                    <h5 class="text-white">
                    <?php
                        $result=$conn->query("SELECT * FROM NguoiDung WHERE QuyenQuanTri=0");
                        echo $result->num_rows;
                    ?>
                    </h5>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img src="./assets/images/product.png" width="50px" height="50px">
                    <h4 class="text-white">Lượng sản phẩm</h4>
                    <h5 class="text-white">
                    <?php
                        $result=$conn->query("SELECT * FROM SanPham");
                        echo $result->num_rows;
                    ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_GET["login"])){
            if($_GET["login"] == "success"){
                echo "<script>showNot('succeeded', 'Đăng nhập thành công')</script>";
            }
        }
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case "invalidMail":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Email không hợp lệ')</script>";
                    break;
                case "invalidUn":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Tên tài khoản không hợp lệ')</script>";
                    break;
                case "incorrectRepwd":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Mật khẩu nhập lại không khớp')</script>";
                    break;
                case "sqlErr":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Lỗi kết nối')</script>";
                    break;
                case "unExist":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Tên tài khoản đã tồn tại')</script>";
                    break;
                case "emExist":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('failed', 'Email đã được sử dụng')</script>";
                    break;
                case "addProduct":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('failed', 'Thêm sản phẩm thất bại')</script>";
                    break;
                case "updateProduct":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('failed', 'Cập nhật sản phẩm thất bại')</script>";
                    break;
                case "size":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('failed', 'Ảnh sản phẩm có kích thước quá lớn (>2mb)')</script>";
                    break;
                case "ext":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('failed', 'Định dạng ảnh không xác định')</script>";
                    break;
                case "img";
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('failed', 'Không thể tải ảnh')</script>";
                    break;
            }
        }
        if(isset($_GET["action"])){
            switch($_GET["action"]){
                case "addUser":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('succeeded','Thêm tài khoản thành công!')</script>";
                    break;
                case "addProduct":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('succeeded','Thêm sản phẩm thành công!')</script>";
                    break;
                case "updateProduct":
                    echo "<script>showProducts()</script>";
                    echo "<script>showNot('succeeded','Cập nhật sản phẩm thành công!')</script>";
                    break;
                case "updateUser":
                    echo "<script>showCustomers()</script>";
                    echo "<script>showNot('succeeded','Cập nhật tài khoản thành công!')</script>";
                    break;
            }
        }

        
    ?>
    
    <script>
        switch(window.location.hash){
            case '#customers' :
                showCustomers();
                break;
            case '#products' :
                showProducts();
                break;
            case '#brands' :
                showBrands();
                break;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script>
        function validateProduct(){
            resetError();
            const name = document.getElementById("name");
            const price = document.getElementById("price");
            const description = document.getElementById("description");
            const brand = document.getElementById("brand");
            const image = document.getElementById("image");
            let isValid = true;
            if (name.value.trim() == "") {
                setError("Vui lòng nhập tên sản phẩm", name);
                isValid = false;
            } else if (!validLength(name.value, 1, 50)) {
                setError("Vui lòng nhập tên sản phẩm từ 1-50 ký tự", name);
                isValid = false;
            } else if (/[~!@#$%^&*()_\-+={}:;.,"`<>?|[\]\\;\/0-9]/.test(name.value)) {
                setError("Tên sản phẩm không được chứa ký tự đặc biệt", name);
                isValid = false;
            }
            if (price.value.trim() == "") {
                setError("Vui lòng nhập giá bán", price);
                isValid = false;
            } else if (!/^\d+$/.test(price.value)){
                setError("Giá bán không hợp lệ", price);
                isValid = false;
            }else if (Number(price.value) < 0) {
                setError("Giá bán không hợp lệ", price);
                isValid = false;
            }
            if (description.value.trim() == "") {
                setError("Vui lòng nhập mô tả", description);
                isValid = false;
            } else if (!validLength(description.value, 5, 255)) {
                setError("Vui lòng nhập mô tả từ 5-255 ký tự", description);
                isValid = false;
            }
            if (brand.value == "0") {
                setError("Vui lòng chọn thương hiệu", brand);
                isValid = false;
            }

            if(image != null){
                if (image.files == null || image.files.length == 0) {
                    setError("Vui lòng chọn ảnh", image);
                    isValid = false;
                }


            }
            if (isValid) {
                document.getElementById("ProductForm").submit();
            }
        }
        function validateAddUser(){

            resetError();
            const email = document.getElementById('email');
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const confirm_password = document.getElementById('confirm_password');
            const address = document.getElementById('address');
            const contact = document.getElementById('contact');
            let isValid = true;

            if(email.value.trim() === ""){
                setError("Vui lòng nhập email!", email);
                isValid = false;
            }else if(!isValidEmail(email.value)){
                isValid = false;
                setError('Email không hợp lệ', email);
            }
            if(username.value.trim() === ""){
                setError("Vui lòng nhập tên tài khoản!", username);
                isValid = false;
            }else if(!validLength(username.value, 1, 50)){
                setError("Vui lòng nhập tên tài khoản trong khoảng 1-50 ký tự", username);
                isValid = false;
            }
            if(password.value.trim() === ""){
                setError("Vui lòng nhập mật khẩu", password);
                isValid = false;
            }else if(!validLength(password.value, 8, 50)){
                isValid = false;
                setError("Vui lòng nhập mật khẩu trong khoảng 8-50 ký tự", password);
            }else if(containSpecialChar(password.value)){
                isValid = false;
                setError("Mật khẩu không được chứa các ký tự đặc biệt", password);
            }
            if(confirm_password.value.trim() === ""){
                setError("Vui lòng nhập lại mật khẩu", confirm_password );
                isValid = false;
            }else if(confirm_password.value != password.value){
                setError("Mật khẩu nhập lại không đúng", confirm_password);
                isValid = false;
            }
            if(address.value.trim() === ""){
                setError("Vui lòng nhập địa chỉ", address);
                isValid = false;
            }else if(!validLength(address.value, 1, 255)){
                setError("Vui lòng nhập địa chỉ trong khoảng 1-255 ký tự", address);
                isValid = false;
            }else if(/[~!@#$%^&*()_\+={}:"`<>?|[\]\\'\/]/.test(address.value)){
                setError("Địa chỉ chứa ký tự không hợp lệ", address);
                isValid = false;
            }
            if(contact.value.trim() === ""){
                setError("Vui lòng nhập số điện thoại", contact);
                isValid = false;
            }else if(!validLength(contact.value, 10, 12)){
                setError("Vui lòng nhập số điện thoại trong khoảng 10-12 số", contact);
                isValid = false;
            }else if(!/^[0-9]*$/.test(contact.value)){
                setError("Số điện thoại chứa ký tự không hợp lệ", contact);
                isValid = false;
            }
            
            if(isValid){
                document.getElementById("addUserForm").submit();
            }
        }
    </script>
</body>
</html>

