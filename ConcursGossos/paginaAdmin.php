<?php
session_start();
require_once 'bd.php';
if($_SESSION["admin"] == false){
    header("Location: iniciSessio.php", true, 303);
}
/*$validat = false;
if(isset($_GET['user']) && isset($_GET['contrasenya'])){
    $validat = comprovarAdmin($_GET['user'], $_GET['contrasenya']);
}
if(!$validat){
    header("Location: index.php?error=userpass", true, 303);
}*/

if(isset($_POST['user']) && isset($_POST['pass']))
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - Concurs Internacional de Gossos d'Atura</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper medium">
        <header>ADMINISTRADOR - Concurs Internacional de Gossos d'Atura</header>
        <div class="admin">
            <div class="admin-row">
                <h1> Resultat parcial: Fase 1 </h1>
                <div class="gossos">
                    <img class="dog" alt="Musclo" title="Musclo 15%" src="img/g1.png">
                    <img class="dog" alt="Jingo" title="Jingo 45%" src="img/g2.png">
                    <img class="dog" alt="Xuia" title="Xuia 4%" src="img/g3.png">
                    <img class="dog" alt="Bruc" title="Bruc 3%" src="img/g4.png">
                    <img class="dog" alt="Mango" title="Mango 13%" src="img/g5.png">
                    <img class="dog" alt="Fluski" title="Fluski 12 %" src="img/g6.png">
                    <img class="dog" alt="Fonoll" title="Fonoll 5%" src="img/g7.png">
                    <img class="dog" alt="Swing" title="Swing 2%" src="img/g8.png">
                    <img class="dog eliminat" alt="Coloma" title="Coloma 1%" src="img/g9.png">
                </div>
            </div>
            <div class="admin-row">
                <h1> Nou usuari: </h1>
                <form method="post" action="processAdmin.php">
                    <input type="text" name="insertarAdmin" placeholder="Nom">
                    <input type="password" name ="contrasenya" placeholder="Contrassenya">
                    <input type="submit" value="Crea usuari">
                </form>
            </div>
            <div class="admin-row">
                <h1> Fases: </h1>
                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name='modificarFase' value="1" readonly  style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name='modificarFase' readonly value="2" style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="3" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="4" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="5" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="6" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="7" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

                <form class="fase-row" action="processFase.php" method="post">
                    Fase <input type="text" name="modificarFase" value="8" readonly style="width: 3em">
                    finalitza al <input type="date" name="dataFase" placeholder="Final">
                    <input type="submit" value="Modifica">
                </form>

            </div>

            <div class="admin-row">
                <h1> Concursants: </h1>
                <br>
                <p>Es modifica a partir del nom:</p>
                <form method="post" action="processGos.php">
                    <input type="hidden" name= "modificar" >
                    <input type="text" name="nom" placeholder="Nom" value="Musclo">
                    <input type="text" name="img" placeholder="Imatge" value="img/g1.png">
                    <input type="text" name="propietari" placeholder="Amo" value="Joan Pere Arnau">
                    <input type="text" name="raça" placeholder="Raça" value="Husky Siberià">
                    <input type="submit" value="Modifica">
                </form>

                <form method="post" action="processGos.php">
                    <input type="hidden" name= "insertar" >
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="text" name="img" placeholder="Imatge">
                    <input type="text" name="propietari" placeholder="Amo">
                    <input type="text" name="raça" placeholder="Raça">
                    <input type="submit" value="Afegeix">
                </form>
            </div>

            <div class="admin-row">
                <h1> Altres operacions: </h1>
                <form method="post" action="processFase.php">
                    Esborra els vots de la fase
                    <input type="number" name="eliminarFase" placeholder="Fase" value="">
                    <input type="submit" value="Esborra">
                </form>
                <form method="post" action="processFase.php">
                    Esborra tots els vots
                    <input type="submit" name="eliminarVots" value="Esborra">
                </form>
            </div>
        </div>
    </div>

</body>

</html>