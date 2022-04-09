<?php

$tipoConsulta = $_POST[ 'tipoConsulta' ];
$typeUser = $_POST[ 'typeUser' ];
$dni_prop = $_POST[ 'dni_prop' ];
switch ( $tipoConsulta ) {
    case 'specific':
    consultar_especifico( $typeUser, $dni_prop );
    break;
    default:
    consultar_todos( $typeUser, $dni_prop );
    break;
}

function connection() {
    //( nombre de la base de datos, $enlace ) mysql_select_db( 'RelocaDB', $link );
    //conexion a la Base de datos ( Servidor, usuario, password )
    $conn = mysqli_connect( 'localhost', 'wiliam', 'wiliamluis(', 'mascotasdb' );
    if ( !$conn ) {
        die( 'Error de conexion: ' . mysqli_connect_error() );
    }
    return $conn;
}

function consultar_especifico( $typeUser, $dni_prop ) {
    $conn = connection();
    //capturando datos
    $v2 = $_POST[ 'nombre' ];
    if ( $typeUser == 'user' ) {
        //consulta SQL
        $sql = "select * from pets where nombre like '".$v2."' AND propietarioDni='$dni_prop'";
    } else {
        //consulta SQL
        //$sql = "select * from pets LEFT JOIN atencion ON pets.dni = atencion.dniMascota UNION SELECT * FROM pets  RIGHT JOIN atencion ON pets.dni = atencion.dniMascota where nombre like '".$v2."'";
        $sql = "select * from pets where nombre like '".$v2."'";
    }
    $result = mysqli_query( $conn, $sql );
    //cuantos reultados hay en la busqueda
    $num_resultados = mysqli_num_rows( $result );

    // creamos un array auxiliar
    $emparray = array();
    // Iniciamos con la conversion a JSON
    while( $row = mysqli_fetch_assoc( $result ) )
 {
        $emparray[] = $row;
    }
    // array de respuesta
    $dataResponce = array(
        'mascotas' => $emparray
    );
    echo json_encode( $dataResponce );
}
//exit;

/* echo '<p>Número de perros encontrados: '.$num_resultados.'</p>';
//mostrando informacion de los perros y detalle
for ( $i = 0; $i <$num_resultados; $i++ ) {
    $row = mysqli_fetch_array( $result );

    //echo ( $i+1 );
    echo ' DNI : '.$row[ 'dni' ];
    echo ' </br>Nombre : '.$row[ 'nombre' ];
    echo ' </br>Raza : '.$row[ 'raza' ];
    echo ' </br>Genero : '.$row[ 'genero' ];
    echo ' </br>Nacio en : '.$row[ 'fechaNacimiento' ];
    echo '</p>';
}
*/

function consultar_todos($typeUser, $dni_prop) {
    $conn = connection();
    if ( $typeUser == 'user' ) {
        // sentencia sql
        $sql = "select * from pets WHERE propietarioDni='$dni_prop'";
    } else {
        // sentencia sql
        $sql = 'select * from pets';
    }

    $result = mysqli_query( $conn, $sql );
    // creamos un array auxiliar
    $emparray = array();
    // Iniciamos con la conversion a JSON
    while( $row = mysqli_fetch_assoc( $result ) )
 {
        $emparray[] = $row;
    }
    // array de respuesta
    $dataResponce = array(
        'mascotas' => $emparray
    );
    echo json_encode( $dataResponce );
}
?>
