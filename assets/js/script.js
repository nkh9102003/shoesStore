function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  // document.getElementById('main-content').style.marginLeft = "250px";
  document.addEventListener("click", autoClose);
}
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  // document.getElementById('main-content').style.marginLeft = "100px";
  document.removeEventListener("click", autoClose);
}
function autoClose(event) {
  var isClickInside = document
    .getElementById("mySidebar")
    .contains(event.target);
  var isClickOpen = document.getElementById("main").contains(event.target);
  if (!isClickInside && !isClickOpen) {
    closeNav();
  }
}
function hideNot(not) {
  not.classList.remove("show");
  not.classList.add("hide");
  setTimeout(function () {
    not.remove();
  }, 2000);
}
function showNot(notType, msg) {
  const notContainer = document.querySelector(".not-container");
  const icon =
    notType === "succeeded"
      ? "fa-circle-check"
      : notType === "failed"
      ? "fa-circle-xmark"
      : notType === "warning"
      ? "fa-triangle-exclamation"
      : "";
  const not = document.createElement("div");
  not.classList.add("not", "showNot", notType, "show");
  const iconEl = document.createElement("span");
  iconEl.classList.add("fas", icon);
  const msgEl = document.createElement("span");
  msgEl.classList.add("msg");
  msgEl.textContent = msg;
  const closeBtn = document.createElement("span");
  closeBtn.classList.add("close-not");
  const xMark = document.createElement("span");
  xMark.classList.add("fas", "fa-times");
  closeBtn.appendChild(xMark);
  closeBtn.addEventListener("click", function () {
    hideNot(not);
  });
  not.appendChild(iconEl);
  not.appendChild(msgEl);
  not.appendChild(closeBtn);
  notContainer.appendChild(not);
  setTimeout(function () {
    hideNot(not);
  }, 5000);
}

function editBrand(id) {
  var tdBrand = document.getElementById("tdBrand" + id);
  var oldBrand = tdBrand.innerText;
  var editButton = document.getElementById("editButton" + id);
  var deleteButton = document.getElementById("deleteButton" + id);

  tdBrand.innerHTML =
    "<input type='text' value='" + oldBrand + "' id='newBrand" + id + "'>";
  document.getElementById("newBrand" + id).focus();
  editButton.innerText = "Lưu";
  editButton.onclick = function () {
    updateBrand(id);
  };
  deleteButton.innerText = "Huỷ";
  deleteButton.onclick = function () {
    cancelEdit(id, tdBrand, oldBrand, editButton, deleteButton);
  };
}
function cancelEdit(id, tdBrand, oldBrand, editButton, deleteButton) {
  tdBrand.innerHTML = oldBrand;
  editButton.innerText = "Sửa";
  editButton.onclick = function () {
    editBrand(id);
  };
  deleteButton.innerText = "Xoá";
  deleteButton.onclick = function () {
    deleteBrand(id);
  };
}
function resetError() {
  document.querySelectorAll(".error-message").forEach(function (msg) {
    msg.remove();
  });
  document.querySelectorAll(".input-error").forEach(function (input) {
    input.classList.remove("input-error");
  });
}
function isValidEmail(email) {
  const regex =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(email);
}
function validLength(password, lowLim, upLim) {
  return password.length >= lowLim && password.length <= upLim;
}
function containSpecialChar(password) {
  return !/^[a-zA-Z0-9]*$/.test(password);
}
function setError(message, element) {
  const errorDiv = document.createElement("div");
  errorDiv.classList.add("error-message");
  errorDiv.textContent = message;
  element.parentNode.insertBefore(errorDiv, element.nextSibling);
  element.classList.add("input-error");
}

function validateUpdateUser() {
  resetError();
  const email = document.getElementById("email");
  const username = document.getElementById("username");
  const address = document.getElementById("address");
  const contact = document.getElementById("contact");
  let isValid = true;

  if (email.value.trim() === "") {
    setError("Vui lòng nhập email!", email);
    isValid = false;
  } else if (!isValidEmail(email.value)) {
    isValid = false;
    setError("Email không hợp lệ", email);
  }
  if (username.value.trim() === "") {
    setError("Vui lòng nhập tên tài khoản!", username);
    isValid = false;
  } else if (!validLength(username.value, 1, 50)) {
    setError("Vui lòng nhập tên tài khoản trong khoảng 1-50 ký tự", username);
    isValid = false;
  }

  if (address.value.trim() === "") {
    setError("Vui lòng nhập địa chỉ", address);
    isValid = false;
  } else if (!validLength(address.value, 1, 255)) {
    setError("Vui lòng nhập địa chỉ trong khoảng 1-255 ký tự", address);
    isValid = false;
  } else if (/[~!@#$%^&*()_\+={}:"`<>?|[\]\\'\/]/.test(address.value)) {
    setError("Địa chỉ chứa ký tự không hợp lệ", address);
    isValid = false;
  }
  if (contact.value.trim() === "") {
    setError("Vui lòng nhập số điện thoại", contact);
    isValid = false;
  } else if (!validLength(contact.value, 10, 12)) {
    setError("Vui lòng nhập số điện thoại trong khoảng 10-12 số", contact);
    isValid = false;
  } else if (!/^[0-9]*$/.test(contact.value)) {
    setError("Số điện thoại chứa ký tự không hợp lệ", contact);
    isValid = false;
  }

  if (isValid) {
    document.getElementById("updateUserForm").submit();
  }
}
