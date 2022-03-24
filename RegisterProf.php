<?php
require __DIR__.'/Tools.php';
//conexion a la Base de datos de usuarios
$conn = mysqli_connect( 'localhost', 'wiliam', 'wiliamluis(', 'mascotasdb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}

//capturando datos
$dni_prof_reg = $_REQUEST[ 'dni_prof_reg' ];
$nombres_prof_reg = $_REQUEST[ 'nombres_prof_reg' ];
$apellidoP_prof_reg = $_REQUEST[ 'apellidoP_prof_reg' ];
$apellidoM_prof_reg = $_REQUEST[ 'apellidoM_prof_reg' ];
$correo_prof_reg = $_REQUEST[ 'correo_prof_reg' ];
$telefono_prof_reg = $_REQUEST[ 'telefono_prof_reg' ];
$direccion_prof_reg = $_REQUEST[ 'direccion_prof_reg' ];
$fechaNac_prof_reg = $_REQUEST[ 'fechaNac_prof_reg' ];
$rol_prof_reg = $_REQUEST[ 'rol_prof_reg' ];
$password = $_REQUEST[ 'pass_prof_reg' ];
$confirm_password = $_REQUEST[ 'prof_confirm_password' ];
$foto_form = $_FILES[ 'foto_prof_reg' ];
$foto_prof_reg;
//data control
$statusProcess = '';
$responce = '';
$validForm = true;

//validando el dni de usuario
if(!preg_match('/^[0-9]{8}$/', trim($dni_prof_reg))) {
    $statusProcess = "failed";
    $responce = 'El dni de profesional debe contener solo números';
    $validForm = false;
} else {
    //preparamos la sentencia sql
    $sql = "SELECT id FROM professionals WHERE dni = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        //vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "s", $param_dni);
        
        //establecer parametros
        $param_dni = trim($dni_prof_reg);
        
        //intento de ejecucion de la sentencia sql
        if(mysqli_stmt_execute($stmt)){
            //guardar el resultado
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $statusProcess = "failed";
                $responce = 'El dni del usuario ya está en uso. Intente con otro dato';
                $validForm = false;
            } else{
                $dni = trim($dni_prof_reg);
            }
        } else{
            $statusProcess = "failed";
            $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
            $validForm = false;
        }
        //cerramos la sentencia sql
        mysqli_stmt_close($stmt);
    }
}

//validando el password
if(!preg_match('/^(?=(?:\D*\d){2,})(?=.*[A-Z]){1,}(?=.*[#$%&\/?]{2,})[a-zA-Z0-9#$%&\/?]{8,}$/', trim($password))){
    $statusProcess = "failed";
    $responce = 'La contraseña debe de tener almenos 8 caracteres, 2 números, 1 mayúscula y 2 caracteres especiales';
    $validForm = false;
} else{
    $password = trim($password);
}

//validando la confirmacion del password
$confirm_password = trim($confirm_password);
if($password != $confirm_password){
    $statusProcess = "failed";
    $responce = 'La confirmación de la contraseña no coincide';
    $validForm = false;
}

//subiendo la foto
$foto_prof_reg = upload_image($foto_form);

//verificando antes de insertar en la base de datos
if($validForm){  
    //preparando la sentencia sql
    $sql = "INSERT INTO professionals (dni, nombres, apellidoM, apellidoP, correo, password, direccion, foto, telefono, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($conn, $sql)){
        //vinculando variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "ssssssssss", $param_dni, $param_nombres, $param_apellidoM, $param_apellidoP, $param_correo, $param_password, $param_direccion, $param_foto, $param_telefono, $param_rol);
        
        //estableciendo los parametros
        $param_dni = $dni;
        $param_nombres = $nombres_prof_reg;
        $param_apellidoM = $apellidoM_prof_reg;
        $param_apellidoP = $apellidoP_prof_reg;
        $param_correo = $correo_prof_reg;
        $param_password = $password;
        $param_direccion = $direccion_prof_reg;
        $param_foto = $foto_prof_reg;
        $param_telefono = $telefono_prof_reg;
        $param_rol = $rol_prof_reg;
        //md5 password
        $param_password = md5($password);
        
        //intento de ejecucion de la sentencia sql
        if(mysqli_stmt_execute($stmt)){
            $responce = 'El profesional ha sido registrado correctamente';
            $statusProcess = "success";
        } else{
            $statusProcess = "failed";
            $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
        }

        //cerramos la sentenia
        mysqli_stmt_close($stmt);
    }
}

//cerramos la coneccion
mysqli_close($conn);

$data_responce = array (
    'status'=> $statusProcess,
    'responce'=> $responce
);
echo json_encode($data_responce);
  
