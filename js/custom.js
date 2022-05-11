$(function () {
  var username = true,
    email = true,
    phone = true,
    message = true;
  function checkErrors() {
    if (username === true || email === true || phone === true || message === true) {
      return false;
    } else {
      return true;
    }
  }
  function valid(selector, value) {
    $("." + selector).blur(function () {
      if ($(this).val().length <= value) {
        $(this).css("border", "1px solid #F00");
        $("." + selector + "~ .custom-alert")
          .animate({ top: "-37px" }, 500)
          .delay(2000)
          .animate({ top: "3px" }, 500)
          .animate({ top: "-150px" }, 1);
        if (selector == "username") {
          username = true;
        } else if (selector == "email") {
          email = true;
        } else if (selector == "phone") {
          phone = true;
        } else if (selector == "message") {
          message = true;
        }
      } else {
        if (selector == "username") {
          username = false;
        } else if (selector == "email") {
          email = false;
        } else if (selector == "phone") {
          phone = false;
        } else if (selector == "message") {
          message = false;
        }
        $(this).css({
          border: "1px solid #080",
          background: "#e8f0fe",
        });
        $("." + selector + "~ .asterisx ").css("color", "#080");
      }
      checkErrors();
    });
  }
  valid("username", 3);
  valid("email", 1);
  valid("phone", 10);
  valid("message", 10);
  $(".contact-form").submit(function (e) {
    if (checkErrors()) {
      console.log("Done checkErrors");
    } else {
      e.preventDefault();
      $(".username, .email, .phone, .message").blur();
    }
  });
});
