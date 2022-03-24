let botones = document.getElementById("botones");
let registrar_boton = document.getElementById("registrar_boton");
let consultar_boton = document.getElementById("consultar_boton");
let volver_boton_reg = document.getElementById("volver_boton_reg");
let volver_boton_con = document.getElementById("volver_boton_con");
let registrar_mascota = document.getElementById("registrar_mascota");
let consultar_mascota = document.getElementById("consultar_mascota");

registrar_boton.addEventListener("click", function () {
    registrar_ventana();
});

consultar_boton.addEventListener("click", function () {
    consultar_ventana();
});

function registrar_ventana() {
    botones.style.display = "none";
    registrar_mascota.style.display = "table-cell";
    volver_boton_reg.style.display = "table-row";
    consultar_mascota.style.display = "none";
    $("#user_profile").hide();
    document.getElementById("success_request").innerHTML = "";
}

function consultar_ventana() {
    botones.style.display = "none";
    consultar_mascota.style.display = "table-cell";
    volver_boton_con.style.display = "table-row";
    registrar_mascota.style.display = "none";
    $("#user_profile").hide();
    document.getElementById("success_request").innerHTML = "";
}

function user_profile() {
    botones.style.display = "none";
    consultar_mascota.style.display = "none";
    registrar_mascota.style.display = "none";
    $("#user_profile").show();
}
 
volver_boton_reg.addEventListener("click", function () {
    registrar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_reg.style.display = "none";
});

volver_boton_con.addEventListener("click", function () {
    consultar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_con.style.display = "none";
    document.getElementById("success_request").innerHTML = "";
    $("#nombre_mascota").val("");
});

$("#inicio_boton").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success").hide();
});

let form_cosulta = document.getElementById("form_request");
let form_registrar = document.getElementById("form_register");

form_cosulta.addEventListener("submit", (event) => {
    event.preventDefault();
    consultar();
});

function consultar() {
    document.getElementById("success_request").innerHTML = "";
    let nombreMascota = document.getElementById("nombre_mascota").value;
    if (nombreMascota == "" || nombreMascota == null) {
        Swal.fire("Es necesario especificar un nombre");
    } else {
        $.ajax({
            url: "Consultar_perro.php",
            type: "post",
            dataType: "json",
            data: {
                nombre: nombreMascota,
                tipoConsulta: "specific",
            },
            success: function (data) {
                mostrarResultadoConsulta(data);
            },
        });
    }
}

form_registrar.addEventListener("submit", (event) => {
    event.preventDefault();
    registrar();
});

function registrar() {
    let codigo_mascota = $("#codigo_mascota").val();
    let nombre_mascota_r = $("#nombre_mascota_r").val();
    let fechaNac_mascota = $("#fechaNac_mascota").val();
    let Genero = document.querySelector('input[name="Genero"]:checked').value;
    let raza_mascota = document.getElementById("raza_mascota").value;
    let formData = new FormData();
    let files = $("#foto_mascota")[0].files[0];
    formData.append("Foto", files);
    formData.append("Codigo", codigo_mascota);
    formData.append("Nombre", nombre_mascota_r);
    formData.append("FechNac", fechaNac_mascota);
    formData.append("Genero", Genero);
    formData.append("Raza", raza_mascota);
    $.ajax({
        url: "Registrar_perro.php",
        type: "post",
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (data) {
            if (data.responce == "success") {
                //document.getElementById("success_register").innerHTML = data.responceData;
                $("#registrar_mascota").hide();
                $("#success").show();
                form_registrar.reset();
            } else {
                alert("Formato de imagen incorrecto.");
            }
        },
    });
}

function mostrarResultadoConsulta(data) {
    let count_result = 0;
    let table = `
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Raza</th>
            <th scope="col">Fecha Nac.</th>
            <th scope="col">Género</th>
            <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (const pet of data.mascotas) {
        let genero_desc = "";
        switch (pet.genero) {
            case '0':
                genero_desc = "Hembra"
                break;
            case '1':
                genero_desc = "Macho"
                break;
        }
        table += `
                <tr>
                    <th scope="row">${++count_result}</th>
                    <td>${pet.nombre}</td>
                    <td>${pet.raza}</td>
                    <td>${pet.fechaNacimiento}</td>
                    <td>${genero_desc}</td>
                    <td><img src="${pet.foto}" alt="Girl in a jacket" width="200"></td>
                </tr>
                `;
    }
    table += `
            </tbody>
        </table>
    `;
    document.getElementById("success_request").innerHTML = table;
}

$("#all_boton_con").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Consultar_perro.php",
        type: "post",
        data: {
            tipoConsulta: "all",
        },
        dataType: "json",
        success: function (data) {
            mostrarResultadoConsulta(data);
        },
    });
});

$("#logout_boton").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Logout.php",
        type: "post",
        dataType: "json",
        complete: function () {
            window.location.replace("http://127.0.0.1/index.php");
        }
    });
});

function registrar_prof_view() {
    botones.style.display = "none";
    $("#registrar_prof").show();

}

$("#form_register_prof").on("submit", function (e) {
    e.preventDefault();
    let dni_prof_reg = $("#dni_prof_reg").val();
    let nombres_prof_reg = $("#nombres_prof_reg").val();
    let apellidoP_prof_reg = $("#apellidoP_prof_reg").val();
    let apellidoM_prof_reg = $("#apellidoM_prof_reg").val();
    let correo_prof_reg = $("#correo_prof_reg").val();
    let telefono_prof_reg = $("#telefono_prof_reg").val();
    let direccion_prof_reg = $("#direccion_prof_reg").val();
    let fechaNac_prof_reg = $("#fechaNac_prof_reg").val();
    let pass_prof_reg = $("#pass_prof_reg").val();
    let prof_confirm_password = $("#prof_confirm_password").val();
    let rol_prof_reg = document.getElementById("rol_prof_reg").value;
    let formData = new FormData();
    let files = $("#foto_prof_reg")[0].files[0];
    formData.append("foto_prof_reg", files);
    formData.append("dni_prof_reg", dni_prof_reg);
    formData.append("nombres_prof_reg", nombres_prof_reg);
    formData.append("apellidoP_prof_reg", apellidoP_prof_reg);
    formData.append("apellidoM_prof_reg", apellidoM_prof_reg);
    formData.append("correo_prof_reg", correo_prof_reg);
    formData.append("telefono_prof_reg", telefono_prof_reg);
    formData.append("direccion_prof_reg", direccion_prof_reg);
    formData.append("fechaNac_prof_reg", fechaNac_prof_reg);
    formData.append("pass_prof_reg", pass_prof_reg);
    formData.append("prof_confirm_password", prof_confirm_password);
    formData.append("rol_prof_reg", rol_prof_reg);
    $.ajax({
        url: "RegisterProf.php",
        type: "post",
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#form_register_prof")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});