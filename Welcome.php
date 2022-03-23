<?php
//inicializando la sesion
session_start();

// Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
if(!isset($_SESSION["loggedin"])){
    header("location: index.php");
    exit;
}
//renderizamos el componente header
$pageHeaderContents = file_get_contents("./components/header.php");
echo str_replace("titulo", "Mascotas", $pageHeaderContents);
//renderizamos el componente navbar
echo file_get_contents("./components/navbar.php");
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" id="container_general">
    <div id="botones" class="">
        <h2 id="title_principal_inicio">
            Bienvenido <?php echo $_SESSION["username"]; ?> a la Página de perritos
        </h2>
        <div id="options_pages_pagina_inicio">
            <input type="button" value="Registar Perrito" id="registrar_boton" class="btn btn-primary">
            <input type="button" value="Consultar Perrito" id="consultar_boton" class="btn btn-primary">
        </div>
    </div>
    <div class="card" id="registrar_mascota" style="width: 30rem; display: none;">
        <div class="text-center">
            <img src="./images/dog1.png" class="carta_img" alt="logo de historia clinica" style="margin: auto;"/>
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">Registro de perritos</h5>
            <form action="#" method="POST" id="form_register" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="codigo_mascota" class="form-label">Ingresar código</label>
                    <input type="text" class="form-control" id="codigo_mascota">
                </div>
                <div class="mb-3">
                    <label for="nombre_mascota_r" class="form-label">Ingresar nombre</label>
                    <input type="text" class="form-control" id="nombre_mascota_r">
                </div>
                <div class="mb-3">
                    <label for="fechaNac_mascota" class="form-label">Ingresar Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNac_mascota">
                </div>
                <div class="mb-3">
                    <label for="Genero" class="form-label">Género</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Genero" id="Genero1" value="1">
                        <label class="form-check-label" for="Genero1">
                            Macho
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Genero" id="Genero2" value="0" checked>
                        <label class="form-check-label" for="Genero2">
                            Hembra
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Genero" class="form-label">Seleccione Raza</label>
                    <Select class="form-select" name="Raza" id="raza_mascota">
                        <Option value="Schnauzer"> Schnauzer </option>
                        <Option value="Pitbull"> Pitbull </option>
                        <Option value="Bulldog"> Bulldog </option>
                        <Option value="Shichu"> Shichu </option>
                        <Option value="Pequines"> Pequines </option>
                        <Option value="San Bernardo"> San Bernardo </option>
                        <Option value="Chiguahua"> Chiguahua </option>
                    </Select>
                </div>

                <div class="mb-3">
                    <label for="foto_mascota" class="form-label">Subir Foto</label>
                    <input class="form-control" type="file" id="foto_mascota">
                </div>
                <div class="acciones_boton">
                    <input name="Registrar" Type="Submit" value="Registrar" class="btn btn-primary">
                    <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_reg">
                </div>
            </form>
        </div>
    </div>
    <div class="card" id="consultar_mascota" style="display: none;">
        <div class="card-body">
            <h4>Sistema de Identificación Perruno</h4>
            <form action="#" method="POST" id="form_request">
                <div class="mb-3">
                    <label for="nombre_mascota" class="form-label">Ingresar Nombre a buscar</label>
                    <input type="text" class="form-control" id="nombre_mascota">
                </div>
                <div class="acciones_boton">
                    <input type="Submit" value="Buscar" class="btn btn-primary">
                    <input type="button" value="Volver" class="btn btn-danger" id="volver_boton_con">
                    <input type="button" value="Mostrar todos" class="btn btn-warning" id="all_boton_con">
                </div>
                <div id="success_request"></div>
            </form>
        </div>
    </div>
    <div id="success" class="" style="display: none;">
        <h2 id="title_principal_inicio">
            ¡Registrado con éxito!
        </h2>
        <div id="options_pages_pagina_inicio">
            <input type="button" value="Inicio" id="inicio_boton" class="boton">
        </div>
    </div>
    <div class="card" id="user_profile" style="width: 30rem; display: none;">
        <div class="text-center">
            <img src="./images/user.png" class="carta_img" alt="logo de historia clinica" style="margin: auto;" />
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Nombre</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $_SESSION["username"]; ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Correo</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $_SESSION["correo"]; ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Teléfono</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    926044465
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Dirección</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    Jr. Alameda Los Pinos 234
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a class="btn btn-warning" href="#">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./mascotas.js"></script>
<?php
//renderizamos el componente footer
$pageFooterContents = file_get_contents("./components/footer.php");
echo $pageFooterContents;
?>