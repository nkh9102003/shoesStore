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
            background-color: bisque;

        }
    </style>
</head>

<body>
    <?php
    include "./header.php";
    ?>

    <div class="container-fluid px-0 allContent-section container">
        <div class="card-account card-container text-center">
            <h3>Đăng nhập</h3>
            <hr>
            <img id="profile-img" class="profile-img-card" src="./assets/images/man-user.svg" alt="Profile picture">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="form-signin" action="./controller/loginValidateController.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="usernameEmail" id="username" class="form-control" placeholder="Tên đăng nhập /Email" autofocus>
                <input type="password" name="password" id="password"  class="form-control" placeholder="Mật khẩu">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login-submit">Đăng nhập</button>
            </form>
            <p>Không có tài khoản? <a href="./register.php">Đăng ký</a></p>
        </div>
        
    </div>
    <?php
    include "./footer.php";
    ?>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "nouser") {
            echo '<script> showNot("failed", "Tài khoản không tồn tại")</script>';
        } else if ($_GET['error'] == "cart") {
            echo '<script> showNot("failed", "Vui lòng đăng nhập!")</script>';
        } else if ($_GET['error'] == "noadmin") {
            echo '<script> showNot("failed", "Yêu cầu quản trị viên!!")</script>';
        } else if ($_GET['error'] == "wrongpassword") {
            echo '<script> showNot("failed", "Mật khẩu không đúng!")</script>';
        } else if ($_GET['error'] == "sqlErr"){
            echo '<script> showNot("failed", "Lỗi kết nối!")</script>';
        }
    } else if (isset($_GET['login']) && $_GET['login'] == "success") {
        echo '<script> showNot("succeeded", "Đăng nhập thành công")</script>';
    } else if (isset($_GET['signup']) && $_GET['signup'] == "success") {
        echo '<script> showNot("succeeded", "Đăng ký thành công!")</script>';
    }
    ?>
    <script>
        document.getElementById('form-signin').addEventListener('submit', function(event){
            event.preventDefault();
            resetError();

            const username = document.getElementById("username");
            const passowrd = document.getElementById("password");
            let isValid = true;
            if(username.value.trim() == ""){
                setError("Vui lòng nhập tên tài khoản", username);
                isValid = false;
            }
            if(password.value.trim() == ""){
                setError("Vui lòng nhập mật khẩu", password);
                isValid = false;
            }
            if(isValid){
                this.submit();
            }
        })
    </script>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>