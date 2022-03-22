if (!sessionStorage.getItem("countCart")) {
  sessionStorage.setItem("countCart", 0);
}
$(document).ready(function () {
  var name, price;
  console.log(new URLSearchParams(window.location.search).get("id"));
  $.ajax({
    url: "/product/getproduct",
    method: "post",
    data: {
      sku: new URLSearchParams(window.location.search).get("id"),
    },
    dataType: "JSON",
  }).done((data) => {
    console.log(data);
    name = data.name;
    price = data.price;
    $(".productName").html(data.name);
    $(".price").html(`$${data.price}`);
    $(".dprice").html(`$${data.price - (data.price * data.discount) / 100}`);
    $(".sku").html(data.sku_no);
    $(".type").html(data.type);
    $(".desc").html(data.description);
  });

  $(".add-to-cart").click(function () {
    $.ajax({
      url: "/cart/operation",
      method: "post",
      data: {
        action: "add",
        id: new URLSearchParams(window.location.search).get("id"),
        name: name,
        price: price,
      },
      dataType: "JSON",
    }).done((data) => {
      console.log("added to cart");
    });
  });
});
