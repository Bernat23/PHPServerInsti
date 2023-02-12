<?php

require_once __DIR__ . '/../../../wp-load.php';
require_once __DIR__ . '/includes/db.php';


if(isset($_POST)) {
    $target_dir = "uploads/tmp/";
    $target_file = $target_dir . basename($_FILES["imageupload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Mira si la imatge és correcte o no és una imatge
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageupload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Mira si el fitxer ja existeix
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Mira la mida del fitxer
    if ($_FILES["imageupload"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Mira el tipus de fitxer que es penja
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // Comprova que no hi hagi errors
    if ($uploadOk == 0) {
    // Si tot és correcte et penjarà la foto
    } else {
        if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)) {
            //Si s'ha pujat la foto s'inserta el registre i es fa el curl
            $url = plugins_url('uploads/tmp/' . $_FILES["imageupload"]["name"], __FILE__);
            
            $error = insertarRegistres($url);
            $error2 = curl($url);
            if($error2 == false || $error == false) {
                wp_redirect( 'http://localhost/wordpress/facelog/?ok=false' );
            }
        }
    }
}

//Es fa el curl al servidor i es retornen les coordendades de les posicions 
// que ens indica el servidor
 function curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://bosc.boscdelacoma.cat:8000/api/v1/detection/detect?face_plugins=landmarks');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => new \CURLFile($url)));
  
    $headers = array();
    $headers[] = 'Content-Type: multipart/form-data';
    $headers[] = 'x-api-key: 3605527e-480c-4e59-a469-c246210d4cd9';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        // Error en la connexió 
        curl_close($ch);
        return false;
    }

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    if (!isset($result["result"])) {
        // Error en la resposta
        curl_close($ch);
        return false;
    }
    
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    var_dump($result);
    $landmarks = $result["result"][0]["landmarks"];
    curl_close($ch);
    return $landmarks;
}
wp_redirect( 'http://localhost/wordpress/facelog/?ok=true' );

define('WP_USE_THEMES', false); 
