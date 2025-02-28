<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/all.css">
    <script src="./assets/js/script.js"></script>

    <style>
        body {
            background-image: url('assets/images/gym-composition-with-sport-elements_23-2147915636.jpeg');
            background-repeat: no-repeat;
            background-size: 100%;
        }

        .card-account {
            border-radius: 5px;
            background-color: antiquewhite;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 10px);
        }
    </style>
</head>

<body>
    <?php
        include "./header.php";
    ?>
    <div class="container-fluid px-0 allContent-section">
        <div class="card-account card-container text-center">
            <h3>Đăng ký tài khoản</h3>
            <hr>
            <img src="./assets/images/man-user.svg" class="profile-img-card" id="profile-img">
            <p class="profile-name-card" id="profile-name"></p>
            <form action="./controller/registerValidateController.php" class="form-signin" id="form-signup" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Tên tài khoản">
                <input type="text" name="email" id="email" class="form-control" placeholder="Địa chỉ email">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
                <input type="text" name="address" id="address" class="form-control" placeholder="Địa chỉ">
                <input type="text" name="contact" id="contact" class="form-control" placeholder="SĐT">
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="signup-submit">Đăng ký</button>
            </form>
            <p>Đã có tài khoản? <a href="./login.php">Đăng nhập</a></p>
        </div>
    </div>
    <?php
        include "./footer.php";
    ?>
    <?php
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case "invalidMail":
                    echo "<script>showNot('failed', 'Email không hợp lệ')</script>";
                    break;
                case "invalidUn":
                    echo "<script>showNot('failed', 'Tên tài khoản không hợp lệ')</script>";
                    break;
                case "incorrectRepwd":
                    echo "<script>showNot('failed', 'Mật khẩu nhập lại không khớp')</script>";
                    break;
                case "sqlErr":
                    echo "<script>showNot('failed', 'Lỗi kết nối')</script>";
                    break;
                case "unExist":
                    echo "<script>showNot('failed', 'Tên tài khoản đã tồn tại')</script>";
                    break;
                case "emExist":
                    echo "<script>showNot('failed', 'Email đã được sử dụng')</script>";
                    break;
            }
        }
    ?>
    <script>

        document.querySelector('#form-signup').addEventListener('submit', function(e){
            e.preventDefault();
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
            }else if(/[~!@#$%^&*()_\+={}:"`<>?|[\]\\'\/]$/.test(address.value)){
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
                this.submit();
            }
        })
    </script>

    <script src="./assets//js/ajaxWork.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
</body>



</html>