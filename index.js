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
    let type = "user";
    $.ajax({
        url: "LoginUser.php",
        type: "post",
        data: {
            nombre_usuario_reg,
            pass_usuario_reg,
            type
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

$(".showHidenPass_span").on("click", function (e) {
    e.preventDefault();
    let x = $(this).parent(".input-group").children(".form-control");
    let show_eye = $(this).children("i.fa-eye");
    let hide_eye = $(this).children("i.fa-eye-slash");
    hide_eye.removeClass("d-none");
    if (x.attr("type") === "password") {
        x.attr("type", "text");
        show_eye.css("display", "none")
        hide_eye.css("display", "block")
    } else {
        x.attr("type", "password");
        show_eye.css("display", "block")
        hide_eye.css("display", "none")
    }
});

$("#prof_login").on("click", function (e) {
    e.preventDefault();
    $("#login_prof_div").show();
    $("#login_div").hide();
    $("#botones_other_login").hide();
    $("#boton_volver_login_index").show();
});

$("#adm_login").on("click", function (e) {
    e.preventDefault();
    $("#login_adm_div").show();
    $("#login_div").hide();
    $("#botones_other_login").hide();
    $("#boton_volver_login_index").show();
});

$("#index_login").on("click", function (e) {
    e.preventDefault();
    $("#login_prof_div").hide();
    $("#login_adm_div").hide();
    $("#login_div").show();
    $("#botones_other_login").show();
    $("#boton_volver_login_index").hide();
});

$("#login_prof_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_prof_log = $("#nombre_prof_log").val();
    let pass_prof_log = $("#pass_prof_log").val();
    let type = "prof";
    $.ajax({
        url: "LoginUser.php",
        type: "post",
        data: {
            nombre_prof_log,
            pass_prof_log,
            type
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_prof_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

$("#login_adm_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_adm_log = $("#nombre_adm_log").val();
    let pass_adm_log = $("#pass_adm_log").val();
    let type = "adm";
    $.ajax({
        url: "LoginUser.php",
        type: "post",
        data: {
            nombre_adm_log,
            pass_adm_log,
            type
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_adm_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});


