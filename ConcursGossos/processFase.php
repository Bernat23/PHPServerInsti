<?php
require_once 'bd.php';

var_dump($_POST);
if(isset($_POST['eliminarFase'])){
    esborrarPerFase($_POST['eliminarFase']);
    echo $_POST['eliminarFase'];
}

elseif(isset($_POST['eliminarVots'])){
    esborrarTotsVots();
}

elseif(isset($_POST['modificarFase']) && isset($_POST['dataFase'])){
    modificarFase($_POST['modificarFase'], $_POST['dataFase']);
    echo "hola";
}




?>