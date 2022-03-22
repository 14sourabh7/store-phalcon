var grandtotal = 0;
var quant;
var items = [];
$(document).ready(function () {
  $.ajax({
    url: "/order/cartoperation",
    method: "post",
    data: { action: "get" },
    dataType: "JSON",
  }).done((data) => {
    console.log("producrts - ", data);

    display(data);
  });
  $.ajax({
    url: "/order/checkoutoperation",
    method: "post",
    data: {
      action: "getUserDetails",
      user_id: sessionStorage.getItem("user_id"),
    },
    dataType: "JSON",
  }).done((data) => {
    console.log("user- ", data);
    $(".name").val(data[0].name);
    $(".email").val(data[0].email);
    $(".mobile").val(data[0].mobile);
    $(".address").val(data[0].address);
    $(".pin").val(data[0].pin);
  });

  /**
   *
   * click listener for place order button
   */
  $(".pay").click(function () {
    var user_id = sessionStorage.getItem("user_id");
    var quantity = quant;
    var total = grandtotal;
    var address = $(".address").val();
    var pin = $(".pin").val();
    var status = "order placed";
    var data = {
      action: "placeOrder",
      user_id: user_id,
      quant: quantity,
      total: total,
      address: address,
      pin: pin,
      status: status,
      cart: JSON.stringify(items),
    };
    if (address && pin) {
      if (isNaN(pin) || pin.length != 6) {
        $(".errorMsg").html("*Please provide valid 6 digit pincode");
        $(".pin").css("border-color", "red");
      } else {
        $.ajax({
          url: "/order/operation",
          method: "post",
          data,
          dataType: "JSON",
        }).done((data) => {
          if (data > 0) {
            $.ajax({
              url: "/order/cartoperation",
              method: "post",
              data: { action: "empty" },
              dataType: "JSON",
            }).done((data) => {
              console.log(data);
              location.replace("/order/confirm");
            });
          }
        });
      }
    } else {
      $(".errorMsg").html("*Please provide address and pincode");
      if (!address) {
        $(".address").css("border-color", "red");
      } else {
        $(".address").css("border-color", "gray");
      }
      if (!pin) {
        $(".pin").css("border-color", "red");
      } else {
        $(".pin").css("border-color", "gray");
      }
    }
  });
  if (sessionStorage.getItem("login") == 1) {
    $("#signinBtn").html("Sign Out");
  } else {
    $("#signinBtn").html("Sign In");
  }

  $("#signinBtn").click(function () {
    sessionStorage.clear();
    if (!sessionStorage.getItem("login")) {
      location.replace("/user");
    }
  });
});
function display(data) {
  var html = "";
  var grandTotal = 0;
  var quantity = 0;

  if (data)
    for (let i = 0; i < data.length; i++) {
      console.log("calligng display");
      var total = data[i].quantity * data[i].price;
      grandTotal += total;
      quantity += Number(data[i].quantity);
      html += `
        <tr class='p-3'>
        <td>${data[i].id}</td>
            <td>${data[i].name}</td>
            <td>${data[i].price}</td>
            <td>
            <a class='btn'><button class='btn fw-bold btnOpr' data-id='${i}' data-op='decrease'>-</button></a>
            ${data[i].quantity}
              <a class='btn'><button class='btn fw-bold btnOpr' data-id='${i}' data-op='increase'>+</button></a>
            </td>
            <td>$${total}</td>
                </tr>
      `;
    }

  html += `
       <tr>
       <td></td>
       <td></td>
        <td></td>
       <td class='h3'>Grand Total - </td>
       <td class='h3'>$${grandTotal}</td>
        </tr> 
    `;
  $(".cartData").html(html);
  grandtotal = grandTotal;
  quant = quantity;
  items = data;
}
