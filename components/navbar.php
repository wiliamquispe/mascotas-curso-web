<?php
    $type_user = $_SESSION["type_user"];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="Welcome.php">
            <img src="./images/logoPets.png" alt="logo_pets" width="50" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Welcome.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Perritos
                    </a>
                    <?php
                if($type_user == "adm") {
                ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" onclick="registrar_ventana()">Registrar</a></li>
                        <li><a class="dropdown-item" href="#" onclick="consultar_ventana()">Buscar</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Atender salud</a></li> -->
                    </ul>
                    <?php
                } else if($type_user == "prof") {
                ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" onclick="registrar_ventana()">Registrar</a></li>
                        <li><a class="dropdown-item" href="#" onclick="consultar_ventana()">Buscar</a></li>
                        <li><a class="dropdown-item" href="#" onclick="atender_ventana()">Atender salud</a></li>
                        <li><a class="dropdown-item" href="#" onclick="estetica_ventana()">Perruquería</a></li>
                    </ul>
                </li>
                <?php
                } else {
                ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" onclick="consultar_ventana()">Buscar</a></li>
                    </ul>
                <?php
                }
                if($type_user == "adm") {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profesionales
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" onclick="registrar_prof_view()">Registrar</a></li>
                        <!-- <li><a class="dropdown-item" href="#" onclick="consultar_ventana()"></a></li>
                        <li><a class="dropdown-item" href="#">Atender salud</a></li> -->
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $_SESSION["foto"]; ?>" alt="image_users" width="40" height="auto"
                            style="border-radius:50%;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" onclick="user_profile()">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="Logout.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>