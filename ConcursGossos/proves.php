<?php
require_once'bd.php';


insertarAdmin('admin','admin');
/*$llistaVotacions = (consultarVots(1));
var_dump($llistaVotacions);
$nVots = 0;
$gos = array();
foreach($llistaVotacions as $votacio){
    $nVots += $votacio["count(*)"];
    $gos[$votacio['gosid']] = array();
    $gos[$votacio['gosid']] = $votacio["count(*)"];
}
foreach($gos as $recompte){
    print_r($recompte);
    for($i = 0; $i < 10 ;$i++){
        if(isset($recompte[$i]))
        echo '<br>'. $recompte[$i] / $nVots;
    }
    
}*/

//abans retornava un statment



?>

