<?php
session_start();
require_once 'bd.php';


if(isset($_POST["modificar"])){
    insertarGos($_POST["nom"], $_POST["raça"],$_POST["propietari"],$_POST["img"]);
} elseif(isset($_POST["insertar"])) {
    insertarGos($_POST["nom"], $_POST["raça"],$_POST["propietari"],$_POST["img"]);
}
if(isset($_SESSION['data'])){
    header("Location: paginaAdmin.php?data=". $_SESSION['data'], true, 302);
} else {
    header("Location: paginaAdmin.php",true,302);
}

?>