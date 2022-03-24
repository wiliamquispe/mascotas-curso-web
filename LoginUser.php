<?php
//inicializando la sesion
//session_start();

$type_login = $_REQUEST[ 'type' ];

$conn = connection_db();
switch ( $type_login ) {
    case 'user':
    $username = $_REQUEST[ 'nombre_usuario_reg' ];
    $password = $_REQUEST[ 'pass_usuario_reg' ];
    //preparando la sentencia de select
    //$sql = 'SELECT id, nombre, correo, password FROM users WHERE nombre = ?';
    //general_login( $username, $password, $conn, $sql, $type_login );
    $sql = "SELECT * FROM users WHERE nombre = $username";
    break;
    case 'prof':
    //$conn = connection_db();
    $username = $_REQUEST[ 'nombre_prof_log' ];
    $password = $_REQUEST[ 'pass_prof_log' ];
    //preparando la sentencia de select
    //$sql = 'SELECT * FROM professionals WHERE dni = ?';
    $sql = "SELECT * FROM professionals WHERE dni = $username";
    //general_login( $username, $password, $conn, $sql, $type_login );
    //general_login_v2( $conn, $sql, $password, $type_login );
    break;
    case 'adm':
    //$conn = connection_db();
    $username = $_REQUEST[ 'nombre_adm_log' ];
    $password = $_REQUEST[ 'pass_adm_log' ];
    //preparando la sentencia de select
    //$sql = 'SELECT id, dni, correo, password FROM admins WHERE codigo = ?';
    //general_login( $username, $password, $conn, $sql, $type_login );
    $sql = "SELECT * FROM admins WHERE codigo = $username";
    break;
}
general_login_v2( $conn, $sql, $password, $type_login );

function connection_db() {
    //conexion a la Base de datos de usuarios
    $conn = mysqli_connect( 'localhost', 'wiliam', 'wiliamluis(', 'mascotasdb' );
    if ( !$conn ) {
        die( 'Error de conexion: ' . mysqli_connect_error() );
    }
    return $conn;
}

function general_login_v2( $conn, $sql, $password, $type_login ) {
    // obtener los resultados
    $resultado = mysqli_query( $conn, $sql );
    $row = mysqli_fetch_assoc( $resultado );
    //data control
    $statusProcess = '';
    $responce = '';
    if ( $row != NULL ) {
        if ( md5( $password ) == $row[ 'password' ] ) {
            // Password es correcto, iniciamos una nueva sesion
            session_start();

            //almacenar las variables de sesion
            $_SESSION[ 'loggedin' ] = true;
            $_SESSION[ 'id' ] = $row[ 'id' ];
            $_SESSION[ 'type_user' ] = $type_login;
            $_SESSION[ 'correo' ] = $row[ 'correo' ];
            $_SESSION[ 'dni' ] = $row[ 'dni' ];
            $_SESSION[ 'direccion' ] = $row[ 'direccion' ];
            $_SESSION[ 'foto' ] = $row[ 'foto' ];
            $_SESSION[ 'telefono' ] = $row[ 'telefono' ];
            switch ( $type_login ) {
                case 'user':
                $_SESSION[ 'username' ] = $row[ 'nombre' ];
                break;
                case 'prof':
                $_SESSION[ 'username' ] = $row[ 'nombres' ];
                $_SESSION[ 'apellidoM' ] = $row[ 'apellidoM' ];
                $_SESSION[ 'apellidoP' ] = $row[ 'apellidoP' ];
                $_SESSION[ 'rol' ] = $row[ 'rol' ];
                break;
                case 'adm':
                $_SESSION[ 'username' ] = $row[ 'nombres' ];
                $_SESSION[ 'apellidoM' ] = $row[ 'apellidoM' ];
                $_SESSION[ 'apellidoP' ] = $row[ 'apellidoP' ];
                $_SESSION[ 'codigo' ] = $row[ 'codigo' ];
                break;
            }

            $statusProcess = 'success';
        } else {
            // Password nos es valido
            $statusProcess = 'failed';
            $responce = 'La contraseña es incorrecta';
        }
    } else {
        //nombre de usuario no existe
        $statusProcess = 'failed';
        $responce = 'El nombre de usuario no existe';
    }
    //cerramos la coneccion
    mysqli_close( $conn );

    $data_responce = array (
        'status'=> $statusProcess,
        'responce'=> $responce
    );
    echo json_encode( $data_responce );
}

function general_login( $username, $password, $conn, $sql, $type_login ) {
    $username = trim( $username );
    $password = trim( $password );

    //data control
    $statusProcess = '';
    $responce = '';

    //validacion de credenciales

    if ( $stmt = mysqli_prepare( $conn, $sql ) ) {
        //vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param( $stmt, 's', $param_username );

        //establecer parametros
        $param_username = $username;

        //intento de ejecucion de la sentencia sql
        if ( mysqli_stmt_execute( $stmt ) ) {
            //guardar resultado
            mysqli_stmt_store_result( $stmt );

            //Verifique si existe el nombre de usuario, si es asi, verifique la contraseña
            if ( mysqli_stmt_num_rows( $stmt ) == 1 ) {
                //vincular las variables de resultados
                mysqli_stmt_bind_result( $stmt, $id, $username, $correo, $hashed_password );
                if ( mysqli_stmt_fetch( $stmt ) ) {
                    //if ( password_verify( $password, $hashed_password ) ) {
                    if ( md5( $password ) == $hashed_password ) {
                        // Password es correcto, iniciamos una nueva sesion
                        session_start();

                        //almacenar las variables de sesion
                        $_SESSION[ 'loggedin' ] = true;
                        $_SESSION[ 'id' ] = $id;
                        $_SESSION[ 'username' ] = $username;

                        $_SESSION[ 'correo' ] = $correo;
                        $_SESSION[ 'type_user' ] = $type_login;

                        $statusProcess = 'success';
                    } else {
                        // Password nos es valido
                        $statusProcess = 'failed';
                        $responce = 'La contraseña es incorrecta';
                    }
                }

            } else {
                //nombre de usuario no existe
                $statusProcess = 'failed';
                $responce = 'El nombre de usuario no existe';
            }
        } else {
            $statusProcess = 'failed';
            $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
        }

        //cerramos la sentencia sql
        mysqli_stmt_close( $stmt );

    }
    //cerramos la coneccion
    mysqli_close( $conn );

    $data_responce = array (
        'status'=> $statusProcess,
        'responce'=> $responce
    );
    echo json_encode( $data_responce );
}

?>