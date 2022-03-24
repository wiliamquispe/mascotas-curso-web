<?php
function upload_image($foto) {
    if ( isset( $foto[ 'name' ] ) ) {
        $image_url;
        // obtenemos el nombre de la imagen
        $filename = $foto[ 'name' ];
    
        // localizamos donde se guardara
        $location = 'upload/'.$filename;
        $imageFileType = pathinfo( $location, PATHINFO_EXTENSION );
        $imageFileType = strtolower( $imageFileType );
    
        // validamos las extensiones deseadas
        $valid_extensions = array( 'jpg', 'jpeg', 'png' );
    
        $response = 0;
        /* verificamos que sean de las extensiones especificadas */
        if ( in_array( strtolower( $imageFileType ), $valid_extensions ) ) {
            // verificamos si existe la imagen
            if(is_file($location)) {
                $image_url = $location;
            } else {
                // subimos la imagen
                if ( move_uploaded_file( $foto[ 'tmp_name' ], $location ) ) {
                    $response = $location;
                    $image_url = $response;
                }
            }
        } else {
            $responceImage = 'Formato o extensión inválida';
            $validForm = false;
        }
    } else {
        $responceImage = 'Imagen no subida';
        $validForm = false;
    }
    return $image_url;
}