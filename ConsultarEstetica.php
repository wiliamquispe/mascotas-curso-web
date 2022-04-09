<?php
//conexion a la Base de datos ( Servidor, usuario, password )
$conn = mysqli_connect( 'localhost', 'wiliam', 'wiliamluis(', 'mascotasdb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}

$codigo_pet = $_POST[ 'codigo_pet' ];

//$sql = "select * from atencion LEFT JOIN pets ON atencion.dniMascota = pets.dni UNION SELECT * FROM atencion  RIGHT JOIN pets ON atencion.dniMascota = pets.dni where dniMascota='$codigo_pet'";
$sql = "select * from atencion_estetica LEFT JOIN pets ON atencion_estetica.dniMascota = pets.dni LEFT JOIN professionals ON atencion_estetica.dniProfesional = professionals.dni where dniMascota='$codigo_pet'";
//$sql2 = "select * from atencion RIGHT JOIN professionals ON atencion.dniProfesional = professionals.dni where dniMascota='$codigo_pet'";
$result = mysqli_query( $conn, $sql );
//$result2 = mysqli_query( $conn, $sql2 );
// creamos un array auxiliar
$emparray = array();
// Iniciamos con la conversion a JSON de la primera respuesta
while( $row = mysqli_fetch_assoc( $result ) )
 {
    $emparray[] = $row;
}
/* // Iniciamos con la conversion a JSON de la segunda respuesta
while( $row = mysqli_fetch_assoc( $result2 ) )
 {
    $emparray[] = $row;
} */
// array de respuesta
$dataResponce = array(
    'esteticas' => $emparray
);
echo json_encode( $dataResponce );