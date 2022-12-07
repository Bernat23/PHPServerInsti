<?php
require_once 'bd.php';

if(isset($_POST["modificar"])){
    insertarGos($_POST["nom"], $_POST["raça"],$_POST["propietari"],$_POST["img"]);
} elseif(isset($_POST["insertar"])) {
    insertarGos($_POST["nom"], $_POST["raça"],$_POST["propietari"],$_POST["img"]);
}
header("Location: paginaAdmin.php");



?>