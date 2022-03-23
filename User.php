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
    <div class="card" id="registrar_mascota" style="width: 30rem;">
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
                    <a class="btn btn-warning" target="__blank" href="#">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./users.js"></script>
<?php
//renderizamos el componente footer
$pageFooterContents = file_get_contents("./components/footer.php");
echo $pageFooterContents;
?>