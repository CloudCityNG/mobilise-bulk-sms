function loginUser() {
    $("#submit_login_error").html("");
    var b = $("#username_login").val();
    var a = $("#p1_login").val();
    $("#submit_login_load").fadeIn(100, function () {
        $.post("ajax/login_user.php", {username: b, password: a}, function (c) {
            var d = jQuery.parseJSON(c);
            if (d.Ack == "success") {
                $("#login_box").fadeOut(300, function () {
                    $("#login_logo").animate({marginTop: "25%"}, 1500, function () {
                        $("#login_txt").fadeIn(100, function () {
                            window.location = "login_groups.php"
                        })
                    })
                })
            } else {
                $("#submit_login_error").html(d.Msg)
            }
            $("#submit_login_load").fadeOut(100)
        })
    })
};