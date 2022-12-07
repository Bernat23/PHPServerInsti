<?php
session_start();
require_once "bd.php";

$iniciar = false;
//Mirem si és admin
if(isset($_SESSION["admin"])){
    if($_SESSION["admin"] == true){
        $iniciar = true;
    }

} //Mirem que la contrasenya sigui correcta
if(isset($_POST['admin']) && isset($_POST["contrasenya"])) {
    if(comprovarAdmin($_POST['admin'],$_POST["contrasenya"])) {
        session_start();
        $_SESSION["admin"] = true;
        $iniciar = true;
    }
} //Mirem si ja existeix l'admin que volem introduir i si no hi és ll'introduïm
elseif(isset($_POST["insertarAdmin"]) && isset($_POST["contrasenya"])) {
    if(!comprovarExisteixAdmin($_POST['insertarAdmin'])){
        insertarAdmin($_POST["insertarAdmin"], $_POST["contrasenya"]);
        $iniciar = true;
    }
    else {
        $_SESSION["error"] = "L'usuari ja existeix";
        $iniciar = true;
    }
}

//Comprovem que ja sigui correcte l'inici
if($iniciar){
    header("Location: paginaAdmin.php", true, 302);
} else {
    header("Location: iniciSessio.php?error=userpass", true, 303);
}

?>