<?php
session_start();
require_once "bd.php";
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultat votació popular Concurs Internacional de Gossos d'Atura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper large">
    <header><h1>Resultat de la votació popular del Concurs Internacional de Gossos d'Atura 2023</h1><br><p> La llista es mostrarà per defecte, perdent l'últim classificat, un cop avanci s'actualitzaran les votacions</p> </header>
    <div class="results">
    <h1> Resultat fase 1 </h1>
    <?php

    //Obtenim els vots de tots els gossos
    $eliminats = [];
    $vots = array();
    $nVots = totalVotsFase(1);
   
    if($nVots == 0) {
        $nVots =1;
    }
    //Guardem tots el vots de cada gos i mirem quin és el que en té menys
    $vots[] = votsPerGos('Musclo', 1);
    $vots[] = votsPerGos('Jingo', 1);
    $vots[] = votsPerGos('Xuia', 1);
    $vots[] = votsPerGos('Bruc', 1);
    $vots[] = votsPerGos('Mango', 1);
    $vots[] = votsPerGos('Fluski', 1);
    $vots[] = votsPerGos('Fonoll', 1);
    $vots[] = votsPerGos('Swing', 1);
    $vots[] = votsPerGos('Coloma', 1);
    $votsMinims = $vots[0]['vots'];
    $gosMinim = $vots[0]['gos'];
    for($i = 1; $i < 9; $i++) {
        if($votsMinims >= $vots[$i]['vots']){
            $votsMinims = $vots[$i]['vots'];
            $gosMinim = $vots[$i]['gos'];
        }
    }

    ?><!-- Mirem quin serà el gos que desactivarem i els percentatges de cada un --> 
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" title="Musclo <?php $gosTot = votsPerGos('Musclo',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" title="Jingo <?php $gosTot = votsPerGos('Jingo',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" title="Xuia <?php $gosTot = votsPerGos('Xuia',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" title="Bruc <?php $gosTot = votsPerGos('Bruc',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" title="Mango <?php $gosTot = votsPerGos('Mango',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" title="Fluski <?php $gosTot = votsPerGos('Fluski',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" title="Fonoll <?php $gosTot = votsPerGos('Fonoll',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" title="Swing <?php $gosTot = votsPerGos('Swing',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" title="Coloma <?php $gosTot = votsPerGos('Coloma',1); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">
    <?php
        $eliminats[]= $gosMinim;
        $vots = array();
        $nVots = totalVotsFase(2);
        if($nVots == 0) {
            $nVots =1;
        }
        //Mirem que no sigui un dels gossos ja eliminat
        $vots[] = votsPerGos('Musclo', 2);
        $vots[] = votsPerGos('Jingo', 2);
        $vots[] = votsPerGos('Xuia', 2);
        $vots[] = votsPerGos('Bruc', 2);
        $vots[] = votsPerGos('Mango', 2);
        $vots[] = votsPerGos('Fluski', 2);
        $vots[] = votsPerGos('Fonoll', 2);
        $vots[] = votsPerGos('Swing', 2);
        $vots[] = votsPerGos('Coloma', 2);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>

    <h1> Resultat fase 2 </h1> <!-- Mirem si el gos ha de ser desactivat-->
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',2); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">

    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(3);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 3);
        $vots[] = votsPerGos('Jingo', 3);
        $vots[] = votsPerGos('Xuia', 3);
        $vots[] = votsPerGos('Bruc', 3);
        $vots[] = votsPerGos('Mango', 3);
        $vots[] = votsPerGos('Fluski', 3);
        $vots[] = votsPerGos('Fonoll', 3);
        $vots[] = votsPerGos('Swing', 3);
        $vots[] = votsPerGos('Coloma', 3);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>
    <h1> Resultat fase 3 </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',3); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">
    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(4);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 4);
        $vots[] = votsPerGos('Jingo', 4);
        $vots[] = votsPerGos('Xuia', 4);
        $vots[] = votsPerGos('Bruc', 4);
        $vots[] = votsPerGos('Mango', 4);
        $vots[] = votsPerGos('Fluski', 4);
        $vots[] = votsPerGos('Fonoll', 4);
        $vots[] = votsPerGos('Swing', 4);
        $vots[] = votsPerGos('Coloma', 4);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>

    <h1> Resultat fase 4 </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',4); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">
    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(5);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 5);
        $vots[] = votsPerGos('Jingo', 5);
        $vots[] = votsPerGos('Xuia', 5);
        $vots[] = votsPerGos('Bruc', 5);
        $vots[] = votsPerGos('Mango', 5);
        $vots[] = votsPerGos('Fluski', 5);
        $vots[] = votsPerGos('Fonoll', 5);
        $vots[] = votsPerGos('Swing', 5);
        $vots[] = votsPerGos('Coloma', 5);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>

    <h1> Resultat fase 5 </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',5); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">


    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(6);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 6);
        $vots[] = votsPerGos('Jingo', 6);
        $vots[] = votsPerGos('Xuia', 6);
        $vots[] = votsPerGos('Bruc', 6);
        $vots[] = votsPerGos('Mango', 6);
        $vots[] = votsPerGos('Fluski', 6);
        $vots[] = votsPerGos('Fonoll', 6);
        $vots[] = votsPerGos('Swing', 6);
        $vots[] = votsPerGos('Coloma', 6);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>
    <h1> Resultat fase 6 </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',6); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">

    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(7);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 7);
        $vots[] = votsPerGos('Jingo', 7);
        $vots[] = votsPerGos('Xuia', 7);
        $vots[] = votsPerGos('Bruc', 7);
        $vots[] = votsPerGos('Mango', 7);
        $vots[] = votsPerGos('Fluski', 7);
        $vots[] = votsPerGos('Fonoll', 7);
        $vots[] = votsPerGos('Swing', 7);
        $vots[] = votsPerGos('Coloma', 7);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
    ?>

    <h1> Resultat fase 7 - Semifinal </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',7); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">

    <?php
        $eliminats[]= $gosMinim;
        
        $vots = array();
        $nVots = totalVotsFase(8);
        if($nVots == 0) {
            $nVots =1;
        }
        $vots[] = votsPerGos('Musclo', 8);
        $vots[] = votsPerGos('Jingo', 8);
        $vots[] = votsPerGos('Xuia', 8);
        $vots[] = votsPerGos('Bruc', 8);
        $vots[] = votsPerGos('Mango', 8);
        $vots[] = votsPerGos('Fluski', 8);
        $vots[] = votsPerGos('Fonoll', 8);
        $vots[] = votsPerGos('Swing', 8);
        $vots[] = votsPerGos('Coloma', 8);
        $votsMinims = $vots[0]['vots'];
        $gosMinim = $vots[0]['gos'];
        for($i = 1; $i < 9; $i++) {
            if($votsMinims >= $vots[$i]['vots'] && !in_array($vots[$i]['gos'], $eliminats)){
                $votsMinims = $vots[$i]['vots'];
                $gosMinim = $vots[$i]['gos'];
            }
        }
        $eliminats[] = $gosMinim;
        $_SESSION['eliminats'] = $eliminats;
    ?>

    <h1> Resultat fase 8 - Final </h1>
    <img class="<?php if($gosMinim == "Musclo")echo 'dog eliminat';else echo "dog";?>" alt="Musclo" <?php foreach($eliminats as $gos) echo $gos; if($gos =="Musclo") echo 'hidden';?> title="Musclo <?php $gosTot = votsPerGos('Musclo',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g1.png">
    <img class="<?php if($gosMinim == "Jingo")echo 'dog eliminat';else echo "dog";?>" alt="Jingo" <?php foreach($eliminats as $gos) if($gos =="Jingo") echo 'hidden';?> title="Jingo <?php $gosTot = votsPerGos('Jingo',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g2.png">
    <img class="<?php if($gosMinim == "Xuia")echo 'dog eliminat';else echo "dog";?>" alt="Xuia" <?php foreach($eliminats as $gos) if($gos =="Xuia") echo 'hidden';?> title="Xuia <?php $gosTot = votsPerGos('Xuia',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g3.png">
    <img class="<?php if($gosMinim == "Bruc")echo 'dog eliminat';else echo "dog";?>" alt="Bruc" <?php foreach($eliminats as $gos) if($gos =="Bruc") echo 'hidden';?> title="Bruc <?php $gosTot = votsPerGos('Bruc',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g4.png">
    <img class="<?php if($gosMinim == "Mango")echo 'dog eliminat';else echo "dog";?>" alt="Mango" <?php foreach($eliminats as $gos) if($gos =="Mango") echo 'hidden';?> title="Mango <?php $gosTot = votsPerGos('Mango',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g5.png">
    <img class="<?php if($gosMinim == "Fluski")echo 'dog eliminat';else echo "dog";?>" alt="Fluski" <?php foreach($eliminats as $gos) if($gos =="Fluski") echo 'hidden';?> title="Fluski <?php $gosTot = votsPerGos('Fluski',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g6.png">
    <img class="<?php if($gosMinim == "Fonoll")echo 'dog eliminat';else echo "dog";?>" alt="Fonoll" <?php foreach($eliminats as $gos) if($gos =="Fonoll") echo 'hidden';?> title="Fonoll <?php $gosTot = votsPerGos('Fonoll',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g7.png">
    <img class="<?php if($gosMinim == "Swing")echo 'dog eliminat';else echo "dog";?>" alt="Swing" <?php foreach($eliminats as $gos) if($gos =="Swing") echo 'hidden';?> title="Swing <?php $gosTot = votsPerGos('Swing',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g8.png">
    <img class="<?php if($gosMinim == "Coloma")echo 'dog eliminat';else echo "dog";?>" alt="Coloma" <?php foreach($eliminats as $gos) if($gos =="Coloma") echo 'hidden';?> title="Coloma <?php $gosTot = votsPerGos('Coloma',8); echo $gosTot['vots']/$nVots * 100;?>%" src="img/g9.png">
    </div>

</div>

</body>
</html>