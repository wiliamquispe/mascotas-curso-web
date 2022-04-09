let botones = document.getElementById("botones");
let registrar_boton = document.getElementById("registrar_boton");
let consultar_boton = document.getElementById("consultar_boton");
let volver_boton_reg = document.getElementById("volver_boton_reg");
let volver_boton_con = document.getElementById("volver_boton_con");
let registrar_mascota = document.getElementById("registrar_mascota");
let consultar_mascota = document.getElementById("consultar_mascota");

/* registrar_boton.addEventListener("click", function () {
    registrar_ventana();
}); */

$('#registrar_boton').on("click", function (e) {
    e.preventDefault();
    registrar_ventana();
})

consultar_boton.addEventListener("click", function () {
    consultar_ventana();
});

function registrar_ventana() {
    botones.style.display = "none";
    registrar_mascota.style.display = "table-cell";
    volver_boton_reg.style.display = "table-row";
    consultar_mascota.style.display = "none";
    $("#user_profile").hide();
    $("#atender_mascota").hide();
    document.getElementById("success_request").innerHTML = "";
    if ($("#registrar_prof").length) {
        $("#registrar_prof").hide();
    }
    if ($("#estetica_mascota").length) {
        $("#estetica_mascota").hide();
    }
}

function consultar_ventana() {
    botones.style.display = "none";
    consultar_mascota.style.display = "table-cell";
    volver_boton_con.style.display = "table-row";
    registrar_mascota.style.display = "none";
    $("#user_profile").hide();
    $("#atender_mascota").hide();
    document.getElementById("success_request").innerHTML = "";
    if ($("#registrar_prof").length) {
        $("#registrar_prof").hide();
    }
    if ($("#estetica_mascota").length) {
        $("#estetica_mascota").hide();
    }
}

function user_profile() {
    botones.style.display = "none";
    consultar_mascota.style.display = "none";
    registrar_mascota.style.display = "none";
    $("#user_profile").show();
}

$("#volver_boton_reg").on("click", function (e) {
    e.preventDefault();
    registrar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_reg.style.display = "none";
})

$("#volver_boton_a").on("click", function (e) {
    e.preventDefault();
    $("#atender_mascota").hide();
    botones.style.display = "table-cell";
})

/* volver_boton_reg.addEventListener("click", function () {
    registrar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_reg.style.display = "none";
}); */

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
                typeUser,
                dni_prop
            },
            success: function (data) {
                if (data.mascotas.length <= 0) {
                    let responce;
                    if (typeUser === "user") {
                        responce = `Usted no cuenta con una mascota con nombre ${nombreMascota}`;
                    } else {
                        responce = `No existen registros de mascotas con el nombre ${nombreMascota}`;
                    }
                    document.getElementById("success_request").innerHTML = responce;
                } else {
                    mostrarResultadoConsulta(data);
                }
            },
        });
    }
}

function registrar() {
    let codigo_mascota = $("#codigo_mascota").val();
    let nombre_mascota_r = $("#nombre_mascota_r").val();
    let dni_prop_r = $("#dni_prop_r").val();
    let fechaNac_mascota = $("#fechaNac_mascota").val();
    let Genero = document.querySelector('input[name="Genero"]:checked').value;
    let raza_mascota = document.getElementById("raza_mascota").value;
    let formData = new FormData();
    let files = $("#foto_mascota")[0].files[0];
    formData.append("Foto", files);
    formData.append("Codigo", codigo_mascota);
    formData.append("Nombre", nombre_mascota_r);
    formData.append("dni_prop_r", dni_prop_r);
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
            <th scope="col">Atenciones</th>
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
                    <td>
                        <button type="button" class="btn btn-success resultados_atenciones_mascotas_button" codigo_pet=${pet.dni}>Resultados salud</button>
                        <button type="button" class="btn btn-warning resultados_esteticas_mascotas_button" codigo_pet=${pet.dni}>Estética</button>
                    </td>
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
            typeUser,
            dni_prop
        },
        dataType: "json",
        success: function (data) {
            if (data.mascotas.length <= 0) {
                let responce;
                if (typeUser === "user") {
                    responce = `Usted no cuenta con ninguna mascota`;
                } else {
                    responce = `No existen registros de mascotas`;
                }
                document.getElementById("success_request").innerHTML = responce;
            } else {
                mostrarResultadoConsulta(data);
            }
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
    consultar_mascota.style.display = "none";
    registrar_mascota.style.display = "none";
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

form_registrar.addEventListener("submit", (event) => {
    event.preventDefault();
    registrar();
});

$("#atender_boton").on("click", function (e) {
    e.preventDefault();
    atender_ventana();
});

function atender_ventana() {
    $("#atender_mascota").show();
    botones.style.display = "none";
    consultar_mascota.style.display = "none";
    registrar_mascota.style.display = "none";
    $("#estetica_mascota").hide();
}

$("#form_atencion_mascota").on("submit", function (e) {
    e.preventDefault();
    let codigo_mascota_a = $("#codigo_mascota_a").val();
    let sangre_mascota_a = $("#sangre_mascota_a").val();
    let medicamentos_mascota_a = $("#medicamentos_mascota_a").val();
    let costo_mascota_a = $("#costo_mascota_a").val();
    let pago_mascota_a = $("#pago_mascota_a").val();
    let diagnos_mascota_a = $("#diagnos_mascota_a").val();
    if (isNaN(costo_mascota_a) || isNaN(pago_mascota_a)) {
        Swal.fire("¡Hubo un problema!", "El pago y el costo deben ser datos numéricos", "warning");
    }
    let formData = new FormData();
    let files = $("#foto_rayosx_mascota_a")[0].files[0];
    formData.append("foto_rayosx_mascota_a", files);
    formData.append("codigo_mascota_a", codigo_mascota_a);
    formData.append("sangre_mascota_a", sangre_mascota_a);
    formData.append("medicamentos_mascota_a", medicamentos_mascota_a);
    formData.append("costo_mascota_a", costo_mascota_a);
    formData.append("pago_mascota_a", pago_mascota_a);
    formData.append("diagnos_mascota_a", diagnos_mascota_a);
    formData.append("dni_vet", dni_vet);
    $.ajax({
        url: "RegisterAtencion.php",
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

$(document).on("click", ".resultados_atenciones_mascotas_button", function (e) {
    e.preventDefault();
    let codigo_pet = $(this).attr("codigo_pet");
    $.ajax({
        url: "ConsultarAtencion.php",
        type: "post",
        dataType: "json",
        data: {
            codigo_pet
        },
        success: function (data) {
            if (data.atenciones.length <= 0) {
                responce = "La mascota no cuenta con alguna atención";
                document.getElementById("resultados_mascotas_body").innerHTML = responce;
            } else {
                mostrarResultadoAtencion(data);
            }
        },
    });
    $("#resultados_mascotas_modal").modal("show");

})

function mostrarResultadoAtencion(data) {
    let count_result = 0;
    let table = `
    <table class="table table-hover">
        <thead class="">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo</th>
            <th scope="col">Fecha Atención</th>
            <th scope="col">Diag. Sangre</th>
            <th scope="col">Rayos X</th>
            <th scope="col">Medicamentos</th>
            <th scope="col">Veterinario</th>
            <th scope="col">Diag. General</th>
            <th scope="col">Costo</th>
            <th scope="col">Monto pagado</th>
            <th scope="col">Deudas</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (const atenction of data.atenciones) {
        table += `
                <tr>
                    <th scope="row">${++count_result}</th>
                    <td>${atenction.nombre}</td>
                    <td>${atenction.dniMascota}</td>
                    <td>${atenction.fechaAtencion}</td>
                    <td>${atenction.diagAnaSangre}</td>
                    <td><img src="${atenction.rayosX}" alt="Girl in a jacket" width="200"></td>
                    <td>${atenction.medicamentos}</td>
                    <td>
                        ${atenction.nombres}
                        <img src="${atenction.foto}" alt="image_users" width="40" height="auto" style="border-radius:50%;">
                    </td>
                    <td>${atenction.diagGeneral}</td>
                    <td>S/${atenction.costo}</td>
                    <td>S/${atenction.pago}</td>
                    <td>S/${parseFloat(atenction.costo) - parseFloat(atenction.pago)}</td>
                </tr>
                `;
    }
    table += `
            </tbody>
        </table>
    `;
    document.getElementById("resultados_mascotas_body").innerHTML = table;
}

$("#registrar_prof_boton").on("click", function (e) {
    e.preventDefault();
    botones.style.display = "none";
    $("#registrar_prof").show();
});

$("#volver_boton_reg_prof").on("click", function (e) {
    e.preventDefault();
    botones.style.display = "table-cell";
    $("#registrar_prof").hide();
});

$("#estetica_boton").on("click", function (e) {
    e.preventDefault();
    $("#estetica_mascota").show();
    botones.style.display = "none";
});

$("#volver_boton_e").on("click", function (e) {
    e.preventDefault();
    botones.style.display = "table-cell";
    $("#estetica_mascota").hide();
});

$("#form_estetica_mascota").on("submit", function (e) {
    e.preventDefault();
    let codigo_mascota_e = $("#codigo_mascota_e").val();
    let unias_mascota_e = document.querySelector('input[name="unias_mascota_e"]:checked').value;
    let tipoBanio_mascota_e = document.querySelector('input[name="tipoBanio_mascota_e"]:checked').value;
    let peinado_mascota_e = $("#peinado_mascota_e").val();
    let tipoSecado_mascota_e = $("#tipoSecado_mascota_e").val();
    let costo_mascota_e = $("#costo_mascota_e").val();
    let pago_mascota_e = $("#pago_mascota_e").val();
    if (isNaN(costo_mascota_e) || isNaN(pago_mascota_e)) {
        Swal.fire("¡Hubo un problema!", "El pago y el costo deben ser datos numéricos", "warning");
    }
    $.ajax({
        url: "RegisterEstetica.php",
        type: "post",
        dataType: "json",
        data: {
            codigo_mascota_e,
            unias_mascota_e,
            tipoBanio_mascota_e,
            peinado_mascota_e,
            tipoSecado_mascota_e,
            costo_mascota_e,
            pago_mascota_e,
            dni_vet
        },
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#form_estetica_mascota")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

function estetica_ventana() {
    $("#estetica_mascota").show();
    $("#atender_mascota").hide();
    botones.style.display = "none";
    consultar_mascota.style.display = "none";
    registrar_mascota.style.display = "none";
}

function mostrarResultadoEstetica(data) {
    let count_result = 0;
    let table = `
    <table class="table table-hover">
        <thead class="">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo</th>
            <th scope="col">Fecha Atención</th>
            <th scope="col">Peinado</th>
            <th scope="col">Uñas</th>
            <th scope="col">Tipo de Baño</th>
            <th scope="col">Tipo de Secado</th>
            <th scope="col">Veterinario</th>
            <th scope="col">Costo</th>
            <th scope="col">Monto pagado</th>
            <th scope="col">Deudas</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (const estetica of data.esteticas) {
        let unias;
        switch (estetica.corteUnias) {
            case '1':
                unias = "Si"
                break;
            case '0':
                unias = "No"
                break;
        }
        table += `
                <tr>
                    <th scope="row">${++count_result}</th>
                    <td>${estetica.nombre}</td>
                    <td>${estetica.dniMascota}</td>
                    <td>${estetica.fechaAtencion}</td>
                    <td>${estetica.peinado}</td>
                    <td>${unias}</td>
                    <td>${estetica.tipoBanio}</td>
                    <td>${estetica.tipoSecado}</td>
                    <td>
                        ${estetica.nombres}
                        <img src="${estetica.foto}" alt="image_users" width="40" height="auto" style="border-radius:50%;">
                    </td>
                    <td>S/${estetica.costo}</td>
                    <td>S/${estetica.pago}</td>
                    <td>S/${parseFloat(estetica.costo) - parseFloat(estetica.pago)}</td>
                </tr>
                `;
    }
    table += `
            </tbody>
        </table>
    `;
    document.getElementById("estetica_mascotas_body").innerHTML = table;
}

$(document).on("click", ".resultados_esteticas_mascotas_button", function (e) {
    e.preventDefault();
    let codigo_pet = $(this).attr("codigo_pet");
    $.ajax({
        url: "ConsultarEstetica.php",
        type: "post",
        dataType: "json",
        data: {
            codigo_pet
        },
        success: function (data) {
            if (data.esteticas.length <= 0) {
                responce = "La mascota no cuenta con alguna atención estética";
                document.getElementById("estetica_mascotas_body").innerHTML = responce;
            } else {
                mostrarResultadoEstetica(data);
            }
        },
    });
    $("#estetica_mascotas_modal").modal("show");

})

/* 
$(".resultados_atenciones_mascotas_button").on("click", function(e) {
    e.preventDefault();
    console.log("holi");
    $("#resultados_mascotas_modal").modal("show");
}); 
<button type="button" class="btn btn-secondary deudas_mascotas_button" codigo_pet=${pet.dni}>Deudas</button>
*/