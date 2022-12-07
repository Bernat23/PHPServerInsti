<?php
require_once 'utils.php';
$status = "error"; // per defecte error genèric
$user_email = null;
$user_data = null;
session_start();

// Resposta al formulari de SIGNIN
if (isset($_POST["method"]) && $_POST["method"] == "signin"){

    // Ens assegurem que hi sigui tot
    if(!isset($_POST["email"]) && !isset($_POST["password"])) die("Incorrect form");
    $nom = comprovar_signin($_POST["email"],md5($_POST["password"]));

    if(is_null($nom)){// Comprova si existeix l'email
        $status = "signin_email_error"; 
        echo'hola';
    }
    elseif($nom == 'incorrecte'){
        $status = "signin_password_error";
        echo'adeu';
    }
    else { // Tot correcte
        $status = "signin_success";
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $_POST['email'];
    }
    $dbh = iniciar_connexio();
    $stmt = $dbh->prepare("INSERT INTO connexions (ip, user, time1, status1) VALUES(?,?,?,?)"); 
    $stmt->execute( array($_SERVER["REMOTE_ADDR"],$_POST['email'],date("Y-m-d H:i:s"), $status)); 
}

// Resposta al formulari de SIGNUP
elseif (isset($_POST["method"]) && $_POST["method"] == "signup"){

    // Ens assegurem que hi sigui tot
    if( !isset($_POST["email"]) && !isset($_POST["password"]) && !isset($_POST["name"])) die("Incorrect form");

    elseif(!str_contains($_POST["email"], "@")){  // Comprova que sigui un email
        $status = "signin_email_error";
    }
    else {
        $status = comprovar_signup($_POST["name"],$_POST["email"],$_POST["password"]);
        if(str_contains($status, "success")) {
            $_SESSION['nom'] = $_POST["name"];
            $_SESSION['email'] = $_POST['email'];
        }
    }
    $dbh = iniciar_connexio();
    $stmt = $dbh->prepare("INSERT INTO connexions (ip, user, time1, status1) VALUES(?,?,?,?)"); 
    $stmt->execute( array($_SERVER["REMOTE_ADDR"],$_POST['email'],date("Y-m-d H:i:s"), $status)); 
}

// Resposta al formulari de tancar la sessió
elseif (isset($_POST["method"]) && $_POST["method"] == "logoff") {
    $status = "logoff";
    $user_email = $_SESSION["user"]["email"] ?? "none";
    session_destroy();
}


// Redireciona PGR a on toqui
if(str_contains($status, "success")) {
    header("Location: hola.php"); // per defecte 302
    $_SESSION["login_time_stamp"] = time();
}
else {
    header("Location: index.php?error=$status", true, 303);
}
