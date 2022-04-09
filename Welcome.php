<?php
//inicializando la sesion
session_start();

// Compruebe si el usuario ya ha iniciado sesión en caso afirmativo, rediríjalo a la página de bienvenida
if ( !isset( $_SESSION[ 'loggedin' ] ) ) {
    header( 'location: index.php' );
    exit;
}
//renderizamos el componente header
$pageHeaderContents = file_get_contents( './components/header.php' );
echo str_replace( 'titulo', 'Mascotas', $pageHeaderContents );
//renderizamos el componente navbar
require __DIR__.'/components/navbar.php';
?>
<div class='d-flex flex-column min-vh-100 justify-content-center align-items-center' id='container_general'>
    <div id='botones' class=''>
        <?php
        switch ($type_user) {
            case 'adm':
                ?>
        <h2 id='title_principal_inicio'>
            Bienvenido <?php echo $_SESSION[ 'username' ]; ?> a la Página de perritos<br><b>(ADMINISTRADOR)</b>
        </h2>
        <?php
                break;
            case 'prof':
                ?>
        <h2 id='title_principal_inicio'>
            Bienvenido <?php echo $_SESSION[ 'username' ]; ?> a la Página de perritos<br><b>(PROFESIONAL)</b>
        </h2>
        <?php
                break;
            case 'user':
                ?>
        <h2 id='title_principal_inicio'>
            Bienvenido <?php echo $_SESSION[ 'username' ]; ?> a la Página de perritos<br><b>(CLIENTE)</b>
        </h2>
        <?php
                break;
        }
        ?>
        <div id='options_pages_pagina_inicio'>
            <?php
            if ( $type_user == 'adm' ) {
            ?>
            <input type='button' value='Registar Perrito' id='registrar_boton' class='btn btn-primary'>
            <input type='button' value='Registar Profesional' id='registrar_prof_boton' class='btn btn-success'>
            <?php
            } else if ( $type_user == 'prof' ) {
            ?>
            <input type='button' value='Registar Perrito' id='registrar_boton' class='btn btn-primary'>
            <input type='button' value='Atender Perrito' id='atender_boton' class='btn btn-success'>
            <input type='button' value='Perruquería' id='estetica_boton' class='btn btn-warning'>
            <?php
            }
            ?>
            <input type='button' value='Buscar Perrito' id='consultar_boton' class='btn btn-danger'>
        </div>
    </div>

    <div class='card' id='registrar_mascota' style='width: 30rem; display: none;'>
        <div class='text-center'>
            <img src='./images/dog1.png' class='carta_img' alt='logo de historia clinica' style='margin: auto;' />
        </div>
        <div class='card-body'>
            <h5 class='card-title text-center'>Registro de perritos</h5>
            <form action='#' method='POST' id='form_register' enctype='multipart/form-data'>
                <div class='mb-3'>
                    <label for='codigo_mascota' class='form-label'>Ingresar código</label>
                    <input type='text' class='form-control' id='codigo_mascota'>
                </div>
                <div class='mb-3'>
                    <label for='nombre_mascota_r' class='form-label'>Ingresar nombre</label>
                    <input type='text' class='form-control' id='nombre_mascota_r'>
                </div>
                <div class='mb-3'>
                    <label for='dni_prop_r' class='form-label'>DNI propietario</label>
                    <input type='text' class='form-control' id='dni_prop_r'>
                </div>
                <div class='mb-3'>
                    <label for='fechaNac_mascota' class='form-label'>Ingresar Nacimiento</label>
                    <input type='date' class='form-control' id='fechaNac_mascota'>
                </div>
                <div class='mb-3'>
                    <label for='Genero' class='form-label'>Género</label>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='Genero' id='Genero1' value='1'>
                        <label class='form-check-label' for='Genero1'>
                            Macho
                        </label>
                    </div>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='Genero' id='Genero2' value='0' checked>
                        <label class='form-check-label' for='Genero2'>
                            Hembra
                        </label>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='Genero' class='form-label'>Seleccione Raza</label>
                    <Select class='form-select' name='Raza' id='raza_mascota'>
                        <Option value='Schnauzer'> Schnauzer </option>
                        <Option value='Pitbull'> Pitbull </option>
                        <Option value='Bulldog'> Bulldog </option>
                        <Option value='Shichu'> Shichu </option>
                        <Option value='Pequines'> Pequines </option>
                        <Option value='San Bernardo'> San Bernardo </option>
                        <Option value='Chiguahua'> Chiguahua </option>
                    </Select>
                </div>

                <div class='mb-3'>
                    <label for='foto_mascota' class='form-label'>Subir Foto</label>
                    <input class='form-control' type='file' id='foto_mascota'>
                </div>
                <div class='acciones_boton'>
                    <input name='Registrar' Type='Submit' value='Registrar' class='btn btn-primary'>
                    <input Type='button' value='Volver' class='btn btn-primary' id='volver_boton_reg'>
                </div>
            </form>
        </div>
    </div>

    <div class='card my-5' id='registrar_prof' style='width: 30rem; display: none;'>
        <!-- <div class = 'text-center'>
        <img src = './images/dog1.png' class = 'carta_img' alt = 'logo de historia clinica' style = 'margin: auto;'/>
        </div> -->
        <div class='card-body'>
            <h5 class='card-title text-center mb-3'>Registro de Profesionales</h5>
            <form action='#' method='POST' id='form_register_prof' enctype='multipart/form-data'>
                <div class='mb-3'>
                    <label for='dni_prof_reg' class='form-label'>Ingresar DNI</label>
                    <input type='text' class='form-control' id='dni_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='nombres_prof_reg' class='form-label'>Nombres</label>
                    <input type='text' class='form-control' id='nombres_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='apellidoP_prof_reg' class='form-label'>Apellido Paterno</label>
                    <input type='text' class='form-control' id='apellidoP_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='apellidoM_prof_reg' class='form-label'>Apellido Materno</label>
                    <input type='text' class='form-control' id='apellidoM_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='correo_prof_reg' class='form-label'>Correo</label>
                    <input type='email' class='form-control' id='correo_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='telefono_prof_reg' class='form-label'>Teléfono</label>
                    <input type='text' class='form-control' id='telefono_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='direccion_prof_reg' class='form-label'>Dirección</label>
                    <input type='text' class='form-control' id='direccion_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='pass_prof_reg' class='form-label'>Password</label>
                    <div class='input-group'>
                        <input type='password' class='form-control' id='pass_prof_reg' required>
                        <span class='input-group-text showHidenPass_span'>
                            <i class='fas fa-eye'></i>
                            <i class='fas fa-eye-slash d-none'></i>
                        </span>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='prof_confirm_password' class='form-label'>Confirmar Password</label>
                    <div class='input-group'>
                        <input type='password' class='form-control' id='prof_confirm_password' required>
                        <span class='input-group-text showHidenPass_span'>
                            <i class='fas fa-eye'></i>
                            <i class='fas fa-eye-slash d-none'></i>
                        </span>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='fechaNac_prof_reg' class='form-label'>Fecha Nacimiento</label>
                    <input type='date' class='form-control' id='fechaNac_prof_reg'>
                </div>
                <div class='mb-3'>
                    <label for='rol_prof_reg' class='form-label'>Seleccione Rol</label>
                    <Select class='form-select' name='rol_prof_reg' id='rol_prof_reg'>
                        <Option value='veterinario'> Veterinario </option>
                        <Option value='asistente'> Asistente </option>
                    </Select>
                </div>
                <div class='mb-3'>
                    <label for='foto_prof_reg' class='form-label'>Foto</label>
                    <input class='form-control' type='file' id='foto_prof_reg'>
                </div>
                <div class='acciones_boton'>
                    <input name='Registrar' Type='Submit' value='Registrar' class='btn btn-success'>
                    <input Type='button' value='Volver' class='btn btn-primary' id='volver_boton_reg_prof'>
                </div>
            </form>
        </div>
    </div>

    <div class='card' id='consultar_mascota' style='display: none;'>
        <div class='card-body'>
            <h4>Sistema de Identificación Perruno</h4>
            <form action='#' method='POST' id='form_request'>
                <div class='mb-3'>
                    <label for='nombre_mascota' class='form-label'>Ingresar Nombre a buscar</label>
                    <input type='text' class='form-control' id='nombre_mascota'>
                </div>
                <div class='acciones_boton'>
                    <input type='Submit' value='Buscar' class='btn btn-primary'>
                    <input type='button' value='Volver' class='btn btn-danger' id='volver_boton_con'>
                    <input type='button' value='Mostrar todos' class='btn btn-warning' id='all_boton_con'>
                </div>
                <div id='success_request'></div>
            </form>
        </div>
    </div>

    <div id='success' class='' style='display: none;'>
        <h2 id='title_principal_inicio'>
            ¡Registrado con éxito!
        </h2>
        <div id='options_pages_pagina_inicio'>
            <input type='button' value='Inicio' id='inicio_boton' class='boton'>
        </div>
    </div>

    <div class='card' id='user_profile' style='width: 30rem; display: none;'>
        <div class='text-center'>
            <img src='./images/user.png' class='carta_img' alt='logo de historia clinica' style='margin: auto;' />
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Nombre</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                    <?php echo $_SESSION[ 'username' ];
                    ?>
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Correo</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                    <?php echo $_SESSION[ 'correo' ];
                    ?>
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Teléfono</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                    926044465
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-3'>
                    <h6 class='mb-0'>Dirección</h6>
                </div>
                <div class='col-sm-9 text-secondary'>
                    Jr. Alameda Los Pinos 234
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-sm-12 text-center'>
                    <a class='btn btn-warning' href='#'>Editar</a>
                </div>
            </div>
        </div>
    </div>

    <div class='card my-5' id='atender_mascota' style='width: 30rem; display: none;'>
        <div class='text-center'>
            <img src='./images/atender_pet.png' class='carta_img' alt='logo de historia clinica'
                style='margin: auto;' />
        </div>
        <div class='card-body'>
            <h5 class='card-title text-center'>Atención de perritos</h5>
            <form action='#' method='POST' id='form_atencion_mascota' enctype='multipart/form-data'>
                <div class='mb-3'>
                    <label for='codigo_mascota_a' class='form-label'>Código de mascota</label>
                    <input type='text' class='form-control' id='codigo_mascota_a' required>
                </div>
                <div class='mb-3'>
                    <label for='sangre_mascota_a' class='form-label'>Diag. Análisis de Sangre</label>
                    <textarea class="form-control" id="sangre_mascota_a" rows="3" required></textarea>
                </div>
                <div class='mb-3'>
                    <label for='medicamentos_mascota_a' class='form-label'>Medicamentos</label>
                    <textarea class="form-control" id="medicamentos_mascota_a" rows="3" required></textarea>
                </div>
                <div class='mb-3'>
                    <label for='foto_rayosx_mascota_a' class='form-label'>Imagen Rayos X</label>
                    <input class='form-control' type='file' id='foto_rayosx_mascota_a' required>
                </div>
                <div class='row mb-3'>
                    <div class="col-6">
                        <label for='costo_mascota_a' class='form-label'>Costo total</label>
                        <div class="input-group">
                            <input type='text' class='form-control' id='costo_mascota_a' required>
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for='pago_mascota_a' class='form-label'>Monto pagado</label>
                        <div class="input-group">
                            <input type='text' class='form-control' id='pago_mascota_a' required>
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='diagnos_mascota_a' class='form-label'>Diagnóstico General</label>
                    <textarea class="form-control" id="diagnos_mascota_a" rows="3"></textarea>
                </div>
                <div class='acciones_boton'>
                    <input name='Registrar' Type='Submit' value='Registrar' class='btn btn-success'>
                    <input Type='button' value='Volver' class='btn btn-primary' id='volver_boton_a'>
                </div>
            </form>
        </div>
    </div>

    <div class='card my-5' id='estetica_mascota' style='width: 30rem; display: none;'>
        <div class='text-center'>
            <img src='./images/estetica_pet.png' class='carta_img' alt='logo de historia clinica'
                style='margin: auto;' />
        </div>
        <div class='card-body'>
            <h5 class='card-title text-center'>Perruquería</h5>
            <form action='#' method='POST' id='form_estetica_mascota' enctype='multipart/form-data'>
                <div class='mb-3'>
                    <label for='codigo_mascota_e' class='form-label'>Código de mascota</label>
                    <input type='text' class='form-control' id='codigo_mascota_e' required>
                </div>
                <div class='mb-3'>
                    <label for='unias_mascota_e' class='form-label'>Corte de uñas</label>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='unias_mascota_e' id='unias_mascota_e1'
                            value='1'>
                        <label class='form-check-label' for='unias_mascota_e1'>
                            Si
                        </label>
                    </div>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='unias_mascota_e' id='unias_mascota_e2'
                            value='0' checked>
                        <label class='form-check-label' for='unias_mascota_e2'>
                            No
                        </label>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='tipoBanio_mascota_e' class='form-label'>Tipo de baño</label>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='tipoBanio_mascota_e'
                            id='tipoBanio_mascota_e1' value='Con espuma'>
                        <label class='form-check-label' for='tipoBanio_mascota_e1'>
                            Con espuma
                        </label>
                    </div>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='tipoBanio_mascota_e'
                            id='tipoBanio_mascota_e2' value='Sin espuma' checked>
                        <label class='form-check-label' for='tipoBanio_mascota_e2'>
                            Sin espuma
                        </label>
                    </div>
                </div>
                <div class='mb-3'>
                    <label for='peinado_mascota_e' class='form-label'>Tipo peinado</label>
                    <Select class='form-select' name='Raza' id='peinado_mascota_e'>
                        <Option value='Clásico'> Clásico </option>
                        <Option value='Lizado'> Lizado </option>
                        <Option value='Raza'> Raza </option>
                    </Select>
                </div>
                <div class='mb-3'>
                    <label for='tipoSecado_mascota_e' class='form-label'>Tipo secado</label>
                    <Select class='form-select' name='Raza' id='tipoSecado_mascota_e'>
                        <Option value='Máquina'> Máquina </option>
                        <Option value='Toalla'> Toalla </option>
                    </Select>
                </div>
                <div class='row mb-3'>
                    <div class="col-6">
                        <label for='costo_mascota_e' class='form-label'>Costo total</label>
                        <div class="input-group">
                            <input type='text' class='form-control' id='costo_mascota_e' required>
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for='pago_mascota_e' class='form-label'>Monto pagado</label>
                        <div class="input-group">
                            <input type='text' class='form-control' id='pago_mascota_e' required>
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='acciones_boton'>
                    <input name='Registrar' Type='Submit' value='Guardar' class='btn btn-success'>
                    <input Type='button' value='Volver' class='btn btn-primary' id='volver_boton_e'>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal resultados salud mascotas -->
<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    id="resultados_mascotas_modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resultados de la atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="resultados_mascotas_body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal resultados salud mascotas -->
<!-- modal resultados estetica mascotas -->
<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    id="estetica_mascotas_modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resultados de las atenciones estéticas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="estetica_mascotas_body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal resultados estetica mascotas -->
<script>
var dni_prop = '';
var dni_vet = '';
var typeUser = "<?php echo $type_user; ?>";
if (typeUser === 'user') {
    dni_prop = "<?php echo $_SESSION['dni']; ?>"
} else if (typeUser === 'prof') {
    dni_vet = "<?php echo $_SESSION['dni']; ?>"
}
</script>
<script src='./mascotas.js?v=<?php echo rand(); ?>'></script>
<?php
//renderizamos el componente footer
$pageFooterContents = file_get_contents( './components/footer.php' );
echo $pageFooterContents;
?>