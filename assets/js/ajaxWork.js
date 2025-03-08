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
  const price = document.getElementById("price");
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
  } else if (Number(size.value) < 35 || Number(size.value) > 45) {
    setError("Vui lòng nhập giá bán trong khoảng 35-45", size);
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
