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
