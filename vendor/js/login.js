// $('.message a').click(function(){
//     $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
// });

//validacija prilikom logovanja
function login() {
    var login_username = $('#login-username').val();
    var login_password = $('#login-password').val();


    if (login_username.length < 3 || login_password.length < 5) {
        $("#failed-login").html("Username or password is/are too short!");
    } else {
        $.ajax({
            type: "POST",
            url: "controllers/login.php",
            data: {
                username: login_username,
                password: login_password
            },
            success: function (result) {
                if (result === "1") {
                    $("#failed-login").html("Redirecting to main page...");
                    $("#loader").show();
                    setTimeout(' window.location.href = "index.php"; ', 3000);
                } else {
                    alert(result)
                    $("#failed-login").html("Wrong credentials!");

                }
            }
        });
    }
}