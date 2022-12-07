<?php
session_start();
require_once "bd.php";
/**
 * Processem la votació del gos
 */
if(isset($_POST["gos"])) {
    $nFase = strval($_SESSION['fase']["num"]);
    if(isset($_SESSION['fases'][$nFase]["vot"])) {
        treureVot($_SESSION['fase']['num'], $_SESSION['fases'][$nFase]['gos']);
    }
    votar($_SESSION['fase']["num"], $_POST["gos"]);
    $_SESSION['fases'][$nFase] = [];
    $_SESSION['fases'][$nFase]["vot"] = true;//últim gos votat;
    $_SESSION['fases'][$nFase]['gos'] = $_POST['gos'];
    var_dump($_SESSION);
}

header("Location: index.php?data=". $_SESSION['data'], true, 303);




?>