<?php
session_start();
require_once 'bd.php';

//Esborrem per fase
if(isset($_POST['eliminarFase'])){
    esborrarPerFase(idFase($_POST['eliminarFase']));
    echo $_POST['eliminarFase'];
}
//Esborrem tots els vots
elseif(isset($_POST['eliminarVots'])){
    esborrarTotsVots();
}
//Modifiquem la data de la fase
elseif(isset($_POST['modificarFase']) && isset($_POST['dataFase'])){
    modificarFase($_POST['modificarFase'], $_POST['dataFase']);
}
//Redireccionarem a a la pàgina admin
if(isset($_SESSION['data'])){
    header("Location: paginaAdmin.php?data=". $_SESSION['data'], true, 302);
} else {
    header("Location: paginaAdmin.php", true, 302);
}



?>