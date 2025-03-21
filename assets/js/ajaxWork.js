function showEachProduct(id) {
  loadDoc(
    "./view/viewEachDetails.php",
    function (xhr) {
      window.scrollTo(0, 0);
      loadAllContent(xhr);
    },
    id
  );
}
function changeOrderStatus(id) {
  if (confirm("Chuyển trạng thái đơn hàng?")) {
    loadDoc("./controller/changeOrderStatusController.php", showOrders, id);
  }
}
function changePayStatus(id) {
  if (confirm("Chuyển trạng thái thanh toán?")) {
    loadDoc("./controller/changePayStatusController.php", showOrders, id);
  }
}
function showOrders() {
  loadDoc("./adminView/viewOrders.php", loadAllContent);
}
function showOrderDetail(id) {
  var button = document.getElementById("openDetailBtn" + id);
  console.log("fuck" + button);
  var dataUrl = button.getAttribute("data-href");
  var xhr = new XMLHttpRequest();
  xhr.open("GET", dataUrl, true);
  xhr.onload = function () {
    if (xhr.status == 200) {
      document.getElementById("orderDetail").innerHTML = xhr.responseText;
      var detailModal = document.getElementById("orderDetailModal");
      detailModal.style.display = "block";
      detailModal.classList.add("show");
      var backdrop = document.createElement("div");
      backdrop.classList.add("cus-modal-backdrop");
      document.body.appendChild(backdrop);
      var button = document.querySelector(".close");
      button.addEventListener("click", function () {
        detailModal.style.display = "none";
        detailModal.classList.remove("show");
        backdrop.classList.remove("cus-modal-backdrop");
      });
    }
  };
  xhr.send();
}
function loadDoc(url, cbFunction, id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    cbFunction(this);
  };
  if (id !== "undefined") {
    var encodedData = "id=" + encodeURIComponent(id);
    xhr.send(encodedData);
  } else {
    xhr.send();
  }
}
function sendFD(url, cbFunction, id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  var form = document.getElementById(id);
  var fd = new FormData(form);
  xhr.onreadystatechange = function () {
    cbFunction(xhr);
  };
  xhr.send(fd);
}

function loadAllContent(xhr) {
  if (xhr.readyState == 4 && xhr.status == 200) {
    document.querySelector(".allContent-section").innerHTML = xhr.responseText;
  }
}

function addToCart(id) {
  var xhr = new XMLHttpRequest();
  var ware_id = document.getElementById("size" + id).value;
  xhr.open("POST", "./controller/addToCartController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.querySelector(".allContent-section").innerHTML =
        xhr.responseText;
      showNot("succeeded", "Thêm thành công!");
      loadDoc("./view/viewMyCart.php", loadAllContent);
    }
  };
  xhr.send("ware_id=" + ware_id);
}

function deleteFromCart(id) {
  loadDoc("./controller/deleteFromCartController.php", showCart, id);
}

function addQuantity(id) {
  loadDoc("./controller/addQuantityController.php", showCart, id);
}
function subtractQuantity(id) {
  loadDoc("./controller/subtractQuantityController.php", showCart, id);
}
function showCart() {
  loadDoc("./view/viewMyCart.php", loadAllContent);
}
function showWarehouse() {
  loadDoc("./adminView/viewWarehouse.php", loadAllContent);
}
function stockIn() {
  var form = document.getElementById("stockInForm");
  var fd = new FormData(form);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./controller/stockInController.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      showNot("succeeded", "Nhập thành công!");
      showWarehouse();
    }
  };
  xhr.send(fd);
}
function stockOut() {
  var oldQuantity = document.getElementById("oldQuantity").value;
  var soQuantity = document.getElementById("soQuantity").value;
  if (oldQuantity <= soQuantity) {
    showNot("failed", "Trữ lượng không đủ!");
  } else {
    sendFD(
      "./controller/stockOutController.php",
      function (xhr) {
        if (xhr.readyState == 4 && xhr.status == 200) {
          showNot("succeeded", "Cập nhật thành công!");
          showWarehouse();
        }
      },
      "stockOutForm"
    );
  }
}
function newStock() {
  resetError();
  const pid = document.getElementById("productId");
  const size = document.getElementById("size");
  const quantity = document.getElementById("quantity");
  let isValid = true;
  if (pid.value == "0") {
    setError("Vui lòng chọn sản phẩm", pid);
    isValid = false;
  }
  if (size.value.trim() == "") {
    setError("Vui lòng nhập size", size);
    isValid = false;
  } else if (!/^\d+$/.test(size.value) || Number(size.value) < 0) {
    setError("Size không hợp lệ", size);
    isValid = false;
  }
  if (quantity.value.trim() == "") {
    setError("Vui lòng nhập số lượng", quantity);
    isValid = false;
  } else if (!/^\d+$/.test(quantity.value) || Number(quantity.value) < 0) {
    setError("Số lượng nhập không hợp lệ", quantity);
    isValid = false;
  }
  if (isValid) {
    $("#newStockModal").modal("hide");
    sendFD(
      "./controller/addStockController.php",
      function (xhr) {
        if (xhr.readyState == 4 && xhr.status) {
          showNot("succeeded", "Nhập hàng thành công!");
          showWarehouse();
        }
      },
      "newStockForm"
    );
  }
}

function deleteStock(id) {
  if (confirm("Xác nhận xoá mặt hàng này?")) {
    loadDoc("./controller/deleteStockController.php", showWarehouse, id);
  }
}
function showCustomers() {
  loadDoc("./adminView/viewCustomers.php", loadAllContent);
}
function showUserForm(id) {
  loadDoc("./adminView/updateUserForm.php", loadAllContent, id);
}

function deleteUser(id) {
  if (confirm("Xác nhận xoá?")) {
    loadDoc("./controller/deleteUserController.php", showCustomers, id);
  }
}

function showProducts() {
  loadDoc("./adminView/viewProducts.php", loadAllContent);
}

function showProductForm(id) {
  loadDoc("./adminView/updateProductForm.php", loadAllContent, id);
}
function deleteProduct(id) {
  if (confirm("Xác nhận xoá sản phẩm?")) {
    loadDoc("./controller/deleteProductController.php", showProducts, id);
  }
}
function showBrands() {
  loadDoc("./adminView/viewBrands.php", loadAllContent);
}
function updateBrand(id) {
  var newBrand = document.getElementById("newBrand" + id).value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./controller/updateBrandController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    showBrands();
  };
  xhr.send("newBrand=" + newBrand + "&id=" + id);
}
function addBrand() {
  var brand = document.getElementById("brand").value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./controller/addBrandController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      showNot("succeeded", "Thêm thành công!");
      showBrands();
    }
  };
  xhr.send("brand=" + brand);
}
function deleteBrand(id) {
  if (confirm("Xác nhận xoá thương hiệu?")) {
    loadDoc("./controller/deleteBrandController.php", showBrands, id);
  }
}
