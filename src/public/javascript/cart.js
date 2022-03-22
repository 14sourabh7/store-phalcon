var gt = 0;
$(document).ready(function () {
  $.ajax({
    url: "/cart/operation",
    method: "post",
    data: { action: "get" },
    dataType: "JSON",
  }).done((data) => {
    console.log("producrts - ", data);
    display(data);
  });

  /**
   * click listener for various cart operations
   */
  $(".cartData").on("click", ".btnOpr", function (e) {
    e.preventDefault();
    $.ajax({
      url: "/cart/operation",
      method: "post",
      data: { id: $(this).data("id"), action: $(this).data("op") },
      dataType: "json",
    }).done((data) => {
      display(data);
    });
  });

  $(".checkOut").click(function () {
    if (sessionStorage.getItem("login") == "1") {
      gt > 0 && location.replace("/checkout");
    } else {
      location.replace("/login");
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
      location.replace("/login");
    }
  });
});
function display(data) {
  var html = "";
  var grandTotal = 0;

  if (data)
    for (let i = 0; i < data.length; i++) {
      console.log("calligng display");
      var total = data[i].quantity * data[i].price;
      grandTotal += total;
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
            <td><a class="btn btn-light btnOpr" data-id='${i}' data-op='delete'>delete</a></td>
                </tr>
      `;
    }

  html += `
       <tr>
       <td></td>
       <td></td>
       <td>Grand Total - </td>
       <td>$${grandTotal}</td>
        <td><a class='empty'>
        <button class='btn btn-success btnOpr' data-op='empty'>EMPTY CART</button>
        </a></td></tr> 
    `;
  $(".cartData").html(html);
  gt = grandTotal;
}
