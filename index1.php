<?php
//inicializando la sesion
session_start();
// Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Welcome.php");
    exit;
}
//renderizamos el componente header
$pageHeaderContents = file_get_contents("./components/header.php");
echo str_replace("titulo", "Inicio", $pageHeaderContents);
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" id="container_general">
    <div class="card" style="width: 20rem; margin: auto;" id="login_div">
        <img src="./images/login_pets.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">Ingreso</h5>
            <form action="" id="login_user_form">
                <div class="mb-3">
                    <label for="nombre_usuario_log" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario_log" required>
                </div>
                <div class="mb-3">
                    <label for="pass_usuario_log" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="pass_usuario_log" required>
                        <span class="input-group-text showHidenPass_span">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-eye-slash d-none"></i>
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Vamos!</button>
                </div>
            </form>
            <div class="text-center mt-1">
                <a href="#" style="color: gray" id="registro_usuario">Únete a nuestro equipo!</a>
            </div>
        </div>
    </div>

    <div class="card" style="width: 20rem; margin: auto; display: none;" id="registro_div">
        <img src="./images/register_pets.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">Registro</h5>
            <form action="" id="register_user_form">
                <div class="mb-3">
                    <label for="nombre_usuario_reg" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_usuario_reg" required>
                </div>
                <div class="mb-3">
                    <label for="dni_usuario_reg" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni_usuario_reg" required>
                </div>
                <div class="mb-3">
                    <label for="correo_usuario_reg" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo_usuario_reg" aria-describedby="emailHelp"
                        required>
                    <div id="emailHelp" class="form-text">Nunca compartiremos tu correo electrónico con nadie
                        más.</div>
                </div>
                <div class="mb-3">
                    <label for="pass_usuario_reg" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="pass_usuario_reg" required>
                        <span class="input-group-text showHidenPass_span">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-eye-slash d-none"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmar Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirm_password" required>
                        <span class="input-group-text showHidenPass_span">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-eye-slash d-none"></i>
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Unete!</button>
                    <a href="#" class="btn btn-warning" id="volver_login_boton">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card" style="width: 20rem; margin: auto; display: none;" id="login_prof_div">
        <img src="./images/login_prof.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">Profesionales</h5>
            <form action="" id="login_prof_form">
                <div class="mb-3">
                    <label for="nombre_usuario_log" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="nombre_prof_log" required>
                </div>
                <div class="mb-3">
                    <label for="pass_usuario_log" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="pass_prof_log" required>
                        <span class="input-group-text showHidenPass_span">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-eye-slash d-none"></i>
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Llévame!</button>
                </div>
            </form>
            <!-- <div class="text-center mt-1">
                <a href="#" style="color: gray" id="registro_usuario">Únete a nuestro equipo!</a>
            </div> -->
        </div>
    </div>

    <div class="card" style="width: 20rem; margin: auto; display: none;" id="login_adm_div">
        <img src="./images/login_adm.png" class="card-img-top px-3 py-3" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">Administradores</h5>
            <form action="" id="login_adm_form">
                <div class="mb-3">
                    <label for="nombre_usuario_log" class="form-label">Código</label>
                    <input type="text" class="form-control" id="nombre_adm_log" required>
                </div>
                <div class="mb-3">
                    <label for="pass_usuario_log" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="pass_adm_log" required>
                        <span class="input-group-text showHidenPass_span">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-eye-slash d-none"></i>
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Ingreso</button>
                </div>
            </form>
        </div>
    </div>

    <div class="my-5" id="botones_other_login">
        <input type="button" value="Profesionales" id="prof_login" class="btn btn-success">
        <input type="button" value="Administradores" id="adm_login" class="btn btn-warning">
    </div>

    <div class="my-5" id="boton_volver_login_index" style="display: none;">
        <input type="button" value="Volver Inicio" id="index_login" class="btn btn-danger">
    </div>
</div>

<script src="./index.js"></script>
<?php
//renderizamos el componente footer
$pageFooterContents = file_get_contents("./components/footer.php");
echo $pageFooterContents;
?>
