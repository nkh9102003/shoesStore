<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <h5 class="mt-5">Hệ thống quản trị</h5>
    </div>
    <hr style="border:1px solid #99C93F";>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="./dashboard.php" ><i class="fa-solid fa-home"></i> Tổng quan</a>
    <a href="#customers" onclick="showCustomers()"><i class="fa-solid fa-users"></i> Tài khoản</a>
    <a href="#products" onclick="showProducts()"><i class="fa-solid fa-table"></i> Sản phẩm</a>
    <a href="#brands" onclick="showBrands()"><i class="fa-solid fa-city"></i> Thương hiệu</a>
    <a href="./logout.php" class="quitAdmin"><i class="fa-solid fa-power-off"></i> Thoát</a>
</div>
<div id="main" class="p-3 position-fixed">
    <button class="openbtn" onclick="openNav()"><i class="fa-solid fa-list"></i></button>
</div>
