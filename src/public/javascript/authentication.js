$(document).ready(function () {
  // if (sessionStorage.getItem("login") == 1) {
  //   location.replace("/");
  // }

  var re = /\S+@\S+\.\S+/;
  $(".signin").click(function () {
    var email = $(".email").val();
    var password = $(".password").val();
    if (email && password) {
      if (!re.test(email)) {
        $("#error").html("");
        var emailErr = "Invalid email format";
        $("#error").html(emailErr);
      } else {
        $.ajax({
          url: "/login/checkuser",
          method: "post",
          data: { action: "signin", email: email, password: password },
          dataType: "json",
        }).done(function (data) {
          if (data.length > 0) {
            if (data[0].status == "approved") {
              sessionStorage.setItem("user_id", data[0].user_id);
              sessionStorage.setItem("name", data[0].name);
              sessionStorage.setItem("email", data[0].email);
              sessionStorage.setItem("role", data[0].role);
              sessionStorage.setItem("login", 1);
              location.replace("/");
            } else {
              $("#error").html("*You are not authorised");
            }
          } else {
            $("#error").html("*Invalid Credentials");
          }
        });
      }
    } else {
      $("#error").html("*Please fill all fields");
    }
  });

  $(".signup").click(function (e) {
    e.preventDefault();
    // variables
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#pwd").val();
    var cnfPassword = $("#cnfpwd").val();

    // input checker
    if (name && email && password && cnfPassword) {
      if (password == cnfPassword) {
        if (!re.test(email)) {
          console.log("invalid email");
          $("#errorMsg").html("");
          var emailErr = "Invalid email format";
          $("#emailError").html(emailErr);
        } else {
          // code to check email already exists
          $.ajax({
            url: "/signup/checkemail",
            method: "post",
            data: {
              action: "validateEmail",
              email: email,
              password: password,
            },
            dataType: "JSON",
          }).done((data) => {
            if (data.length > 0) {
              $("#emailError").html("*Email already exists");
            } else {
              $("#emailError").html("");
              console.log("adding");

              // ajax call to add user
              $.ajax({
                url: "/signup/register",
                method: "post",
                data: {
                  action: "addUser",
                  email: email,
                  password: password,
                  name: name,
                },
                dataType: "JSON",
              }).done((data) => {
                console.log("replacing");
                location.replace("/login");
              });
            }
          });
        }
      } else {
        $("#errorMsg").html("Password mismatch");
      }
    } else {
      $("#errorMsg").html("Please fill all details");
    }
  });
});
