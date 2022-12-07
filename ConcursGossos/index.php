<?php
session_start();
require_once "bd.php";
//Mirem si li passem una data sinó escriu l'actual;
if(isset($_GET['data'])){
    $_SESSION["data"] = $_GET["data"];
} else {
    $_SESSION["data"] =  $date = date('Y-m-d', time());
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votació popular Concurs Internacional de Gossos d'Atura 2023</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <header>Votació popular del Concurs Internacional de Gossos d'Atura 2023- FASE <span> <?php $_SESSION["fase"] = comprovarFase($_SESSION["data"]);echo $_SESSION['fase']["num"];?></span></header>
    <p class="info"> <?php if(isset($_SESSION["fase"]["datafinal"])) echo 'Podeu votar fins aquesta data' . $_SESSION["fase"]["datafinal"]; else echo 'Data no disponible per les votacions'; ?></p>

    <p class="warning"><?php if(isset($_SESSION['fases'][$_SESSION['fase']['num']]['vot'])) echo "RECORDA QUE J'HAS VOTAT"?></p>
    <div class="poll-area">
        <form method="post" action="process.php"><!--Comprovem quin són els gossos que s'han de desactivar-->
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-1" value="Musclo" <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Musclo" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-2" value="Jingo"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Jingo" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-3" value="Xuia"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Xuia" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-4" value="Bruc"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Bruc" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-5" value="Mango"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Mango" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-6" value="Fluski"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Fluski" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-7" value="Fonoll"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Fonoll" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-8" value="Swing"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Swing" == $eliminat)echo 'hidden';?> >
        <input type="checkbox" name="gos" onchange="this.form.submit();" id="opt-9" value="Coloma"  <?php if(!isset($_SESSION["fase"]["datafinal"])) echo 'disabled'; if(isset($_SESSION['eliminats'])) foreach($_SESSION['eliminats'] as $eliminat) if("Coloma" == $eliminat)echo 'hidden';?> >
        <label for="opt-1" class="opt-1">
            <div class="row">
                <div class="column">
                    <div class="right">
                    <span class="circle"></span>
                    <span class="text">Musclo</span>
                    </div>
                    <img class="dog"  alt="Musclo" src="img/g1.png">
                </div>
            </div>
        </label>
        <label for="opt-2" class="opt-2">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Jingo</span>
                    </div>
                    <img class="dog"  alt="Jingo" src="img/g2.png">
                </div>
            </div>
        </label>
        <label for="opt-3" class="opt-3">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Xuia</span>
                    </div>
                    <img class="dog"  alt="Xuia" src="img/g3.png">
                </div>
            </div>
        </label>
        <label for="opt-4" class="opt-4">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Bruc</span>
                    </div>
                    <img class="dog"  alt="Bruc" src="img/g4.png">
                </div>
            </div>
        </label>
        <label for="opt-5" class="opt-5">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Mango</span>
                    </div>
                    <img class="dog"  alt="Mango" src="img/g5.png">
                </div>
            </div>
        </label>
        <label for="opt-6" class="opt-6">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Fluski</span>
                    </div>
                    <img class="dog"  alt="Fluski" src="img/g6.png">
                </div>
            </div>
        </label>
        <label for="opt-7" class="opt-7">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Fonoll</span>
                    </div>
                    <img class="dog"  alt="Fonoll" src="img/g7.png">
                </div>
            </div>
        </label>
        <label for="opt-8" class="opt-8">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Swing</span>
                    </div>
                    <img class="dog"  alt="Swing" src="img/g8.png">
                </div>
            </div>
        </label>
        <label for="opt-9" class="opt-9">
            <div class="row">
                <div class="column">
                    <div class="right">
                        <span class="circle"></span>
                        <span class="text">Coloma</span>
                    </div>
                    <img class="dog"  alt="Coloma" src="img/g9.png">
                </div>
            </div>
        </label>
        </form>
    </div>

    
    <p> Mostra els <a href="resultats.php">resultats</a> de les fases anteriors.</p>
</div>

</body>
</html>