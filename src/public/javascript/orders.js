$(document).ready(function () {
  if (sessionStorage.getItem("login") == "1") {
    getOrders();
  } else {
    location.replace("/login");
  }
});

$("body").on("click", ".viewItem", function () {
  $(this).siblings(".items").toggle();
});

if (sessionStorage.getItem("login") == 1) {
  $("#signinBtn").html("Sign Out");
} else {
  $("#signinBtn").html("Sign In");
}

$("#signinBtn").click(function () {
  sessionStorage.clear();
  if (!sessionStorage.getItem("login")) {
    location.replace("/login");
  }
});

function getOrders() {
  var user_id = sessionStorage.getItem("user_id");
  $.ajax({
    url: "/order/operation",
    method: "post",
    data: { action: "getOrders", user_id: user_id },
    dataType: "JSON",
  }).done((data) => {
    displayOrders(data);
  });
}

function displayOrders(data) {
  var html = "";

  for (let i = 0; i < data.length; i++) {
    var itemList = "<ol class='items' style='display:none;'>";
    var items = JSON.parse(data[i].cart);
    for (let j = 0; j < items.length; j++) {
      itemList += `
        <li>${items[j].id} -  ${items[j].name} - ${items[j].price}</li>
        `;
    }
    html += `<tr>
        <td>${data[i].order_id}</td>
        <td>${data[i].amount}</td>
        <td>${data[i].quantity}</td>
        <td>${data[i].date}</td>
        <td>
        <span class='text-danger viewItem' style='cursor:pointer'>
        View Items
        </span>
        ${itemList}</ol>
        </td>
        <td>${data[i].status}</td>
        </tr>
        `;
  }
  $(".orderData").html(html);
}
