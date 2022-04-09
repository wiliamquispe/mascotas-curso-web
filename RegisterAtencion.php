<?php
require __DIR__.'/Tools.php';
//conexion a la Base de datos de usuarios
$conn = mysqli_connect( 'localhost', 'wiliam', 'wiliamluis(', 'mascotasdb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}

//capturando datos
$codigo_mascota_a = $_REQUEST[ 'codigo_mascota_a' ];
$sangre_mascota_a = $_REQUEST[ 'sangre_mascota_a' ];
$medicamentos_mascota_a = $_REQUEST[ 'medicamentos_mascota_a' ];
$costo_mascota_a = $_REQUEST[ 'costo_mascota_a' ];
$pago_mascota_a = $_REQUEST[ 'pago_mascota_a' ];
$diagnos_mascota_a = $_REQUEST[ 'diagnos_mascota_a' ];
$foto_rayosX_form = $_FILES[ 'foto_rayosx_mascota_a' ];
$dni_vet = $_REQUEST[ 'dni_vet' ];
$foto_atencion_rayosX_reg;
//data control
$statusProcess = '';
$responce = '';
$validForm = true;

/* validando el codigo de la mascota */
//preparamos la sentencia sql
$sql = "SELECT id FROM pets WHERE dni = ?";

if($stmt = mysqli_prepare($conn, $sql)){
    //vincular variables a la declaración preparada como parámetros
    mysqli_stmt_bind_param($stmt, "s", $param_dni);
    
    //establecer parametros
    $param_dni = trim($codigo_mascota_a);
    
    //intento de ejecucion de la sentencia sql
    if(mysqli_stmt_execute($stmt)){
        //guardar el resultado
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) == 1){
            $codigo_mascota_a = trim($codigo_mascota_a);
        } else{
            $statusProcess = "failed";
            $responce = 'El código de la mascota no existe. Intente con otro dato';
            $validForm = false;
        }
    } else{
        $statusProcess = "failed";
        $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
        $validForm = false;
    }
    //cerramos la sentencia sql
    mysqli_stmt_close($stmt);
}

//subiendo la foto
$foto_atencion_rayosX_reg = upload_image($foto_rayosX_form);

//verificando antes de insertar en la base de datos
if($validForm){  
    //preparando la sentencia sql
    $sql = "INSERT INTO atencion (rayosx, diagAnaSangre, diagGeneral, medicamentos, costo, pago, dniMascota, dniProfesional) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($conn, $sql)){
        //vinculando variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "ssssssss", $foto_atencion_rayosX_reg, $sangre_mascota_a, $diagnos_mascota_a, $medicamentos_mascota_a, $costo_mascota_a, $pago_mascota_a, $codigo_mascota_a, $dni_vet);

        //intento de ejecucion de la sentencia sql
        if(mysqli_stmt_execute($stmt)){
            $responce = 'La atención ha sido registrada correctamente';
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
  
