$("#registro_usuario").on("click", function (e) {
    e.preventDefault();
    $("#login_div").hide();
    $("#registro_div").show();
});

$("#volver_login_boton").on("click", function (e) {
    e.preventDefault();
    $("#login_div").show();
    $("#registro_div").hide();
});

$("#login_user_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_usuario_reg = $("#nombre_usuario_log").val();
    let pass_usuario_reg = $("#pass_usuario_log").val();
    $.ajax({
        url: "LoginUser.php",
        type: "post",
        data: {
            nombre_usuario_reg,
            pass_usuario_reg,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_user_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

$("#register_user_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_usuario_reg = $("#nombre_usuario_reg").val();
    let correo_usuario_reg = $("#correo_usuario_reg").val();
    let pass_usuario_reg = $("#pass_usuario_reg").val();
    let confirm_password = $("#confirm_password").val();
    $.ajax({
        url: "RegisterUser.php",
        type: "post",
        data: {
            nombre_usuario_reg,
            correo_usuario_reg,
            pass_usuario_reg,
            confirm_password,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#register_user_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

$(".showHidenPass_span").on("click", function(e) {
    e.preventDefault();
    let x = $(this).parent(".input-group").children(".form-control");
    let show_eye = $(this).children("i.fa-eye");
    let hide_eye = $(this).children("i.fa-eye-slash");
    hide_eye.removeClass("d-none");
    if (x.attr("type") === "password") {
        x.attr("type", "text");
        show_eye.css("display","none")
        hide_eye.css("display","block")
    } else {
        x.attr("type", "password");
        show_eye.css("display","block")
        hide_eye.css("display","none")
    }
});