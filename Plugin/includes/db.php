<?php

//Funció que retorna els registres de la base de dades 
//amb només el link de la imatge i la data
function facelog_dbget() {
    global $wpdb;
    $query = "SELECT image, date FROM " . $wpdb->prefix . "images WHERE user = %s ORDER BY date ASC";
    $results = $wpdb->get_results($wpdb->prepare($query, wp_get_current_user()->user_login), OBJECT);
    return $results;
}

//Funció que inserta els registres a la base de dades de la informació de la foto
function insertarRegistres($url) {
    global $wpdb;
    $nom = $_FILES['imageupload']['name'];
    if(isset($_POST['date']) && $_POST['date'] != ''){
        $data = $_POST['date'];
    } else {
        $data = date("d/m/Y");
    }
    $dataBD = date("Y-m-d", strtotime($data));
    $tabla = $wpdb->prefix . "images";
    $sql = $wpdb->prepare("INSERT INTO $tabla (nom, date, user, image) VALUES(%s, %s, %s ,%s)", $nom, $dataBD ,wp_get_current_user()->user_login, $url);
    $result = $wpdb->query($sql);
    if ($result === false) {
        return false;
    }else {
        return true;
    }
    }


    //Crear taula de registre de les imatges penjades
function crearTaula(){
    global $wpdb;
    $tabla = $wpdb->prefix . "images";
    $sql = "CREATE TABLE $tabla (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image VARCHAR(200),
        nom VARCHAR(200),
        date DATE,
        user VARCHAR(50)
    );";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }


//Borra la taula de la base de dades
function borrarTaula() {
    global $wpdb;
    $tabla = $wpdb->prefix . "images";
    $sql = "DROP TABLE $tabla";
    $wpdb->query($sql);
  }