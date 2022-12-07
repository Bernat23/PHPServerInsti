<?php
require_once "fase.php";
require_once "gos.php";

function connexio(){
  try {
    $hostname = "localhost";
    $dbname = "concursgossostura";
    $username = "dwes-user";
    $pw = "dwes-pass";
    $dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
    }
    return $dbh;
}


/*TAULA ADMIN */
function insertarAdmin($user, $password) {
  $dbh = connexio();
  $stmt = $dbh->prepare("INSERT INTO admin (user, password) VALUES(?,MD5(?))"); 
  $stmt->execute( array($user,$password));
}

function comprovarAdmin($user, $password) {
  $dbh = connexio();
  $stmt = $dbh->prepare("SELECT user, password FROM admin  WHERE user = ? and password = ?"); 
  $stmt->execute( array($user,md5($password)));
  $result = $stmt -> fetch();
  if(empty($result)){
    return false;
  }
  return true;
}

function obtenirAdmin($user, $password) {
  $dbh = connexio();
  $stmt = $dbh->prepare("SELECT user, password FROM admin  WHERE user = ? and password = ?"); 
  $stmt->execute( array($user,md5($password)));
  $result = $stmt -> fetch();
  if(empty($result)){
    return false;
  }
  return true;
}

//Comprova si l'usuari que li passem ja existeix a la taula admin
function comprovarExisteixAdmin($user) {
  $dbh = connexio();
  $stmt = $dbh->prepare("SELECT user FROM admin  WHERE user = ?"); 
  $stmt->execute( array($user));
  $result = $stmt -> fetch();
  if(empty($result)){
    return false;
  }
  return true;
}



/*TAULA GOS */
function insertarGos($nom, $raça, $propietari, $img) {
  $dbh = connexio();
  $stmt = $dbh->prepare("INSERT INTO gos (nom, raça, propietari, img) VALUES(?,?,?,?)"); 
  $stmt->execute( array($nom, $raça, $propietari, $img));
}

function modificarGos($nom, $raça, $propietari, $img){
  $dbh = connexio();
  $stmt = $dbh->prepare("UPDATE gos SET raça= ? , propietari= ?, img=? WHERE nom= ?");
  $stmt->execute( array($raça, $propietari, $img, $nom));
}

function eliminarGos($nom) {
  $dbh = connexio();
  $stmt = $dbh->prepare("DELETE FROM gos WHERE nom=?");
  $stmt -> execute($nom);
}

function obtenirNomGos($nom) {
  $dbh = connexio();
  $stmt = $dbh->prepare("SELECT nom, raça, propietari, img FROM GOS WHERE nom = ?;"); 
  $stmt->execute( array($nom));
  $result = $stmt -> fetch();
  return $result;
}

function idGos($gos){
  $dbh = connexio();
  $stmt = $dbh -> prepare("SELECT id FROM gos WHERE nom = ?");
  $stmt -> execute(array($gos));
  $idGos = $stmt ->fetch();
  return $idGos['id'];
}

function obtenirGos($nom) {
  $dbh = connexio();
  $stmt = $dbh->prepare("SELECT nom, raça, propietari, img FROM GOS WHERE nom = ?;"); 
  $stmt->execute( array($nom));
  $result = $stmt -> fetch();
  $gos = new Gos($result["nom"], $result["raça"], $result["propietari"], $result["img"]);
  return $gos;
}

function obtenirTotsElsGossos(){
  $dbh = connexio();
  $llistGossos = null;
  $stmt = $dbh -> prepare("SELECT nom, raça, propietari, img FROM gos;");
  $stmt->execute();
  foreach($stmt as $gos){
    $llistGossos[] = $gos;
  }
  return $llistGossos;
}


/*TAULA FASE*/

//Funció per modificar les dates d'una fase, comprova si és una data correcta.
function modificarFase($fase, $dataFinal) {
  $dbh = connexio();
  if(empty((int)$dataFinal)) {
    $_SESSION['errorValor'] = "Data invàlida";
  } else {
    try {
      $stmt = $dbh -> prepare("UPDATE fase SET dataFinal = ? WHERE  num = ? ");
      $stmt -> execute(array($dataFinal, $fase));
    }
    catch(PDOException $e){
      var_dump($e);   
    }
  }
}


//La funció retorna a quina fase estem
function comprovarFase($data){
  $dbh = connexio();
  $stmt = $dbh -> prepare("SELECT datafinal, num FROM fase WHERE datafinal >= ?");
  $stmt -> execute(array($data));
  $primeraFila = null;
  $primera = false;
  foreach($stmt as $fila) {
    if(!$primera) {
      $primeraFila = $fila;
      $primera = true;
    }
  }
  if(empty($primeraFila)){
    return 0;
  }
  return $primeraFila;
}

//Funció que retorna l id de la fase

function idFase($fase){
  $dbh = connexio();
  $stmt = $dbh -> prepare("SELECT id FROM fase WHERE num = ?");
  $stmt -> execute(array($fase));
  $idFase = $stmt ->fetch();
  return $idFase['id'];
}



/*TAULA RESULTAT */
function insertarVot($faseid, $gosid) {
  $dbh = connexio();
  $stmt = $dbh -> prepare("INSERT INTO resultat (faseid, gosid) VALUES(?,?)");
  $stmt -> execute(array($faseid, $gosid));
  
}

function eliminarVot($faseid, $gosid){
  $dbh = connexio();
  $stmt = $dbh -> prepare("DELETE FROM resultat WHERE faseid=? AND gosid = ? LIMIT 1");
  $stmt -> execute(array($faseid, $gosid));
  $stmt -> fetch();
  
}

function esborrarPerFase($faseid) {
  $dbh = connexio();
  $stmt = $dbh -> prepare("DELETE FROM resultat WHERE faseid = ?");
  $stmt -> execute(array($faseid));
}


//Borra tots els vots de la taula resultat
function esborrarTotsVots() {
  $dbh = connexio();
  $stmt = $dbh -> prepare("DELETE FROM resultat");
  $stmt -> execute();
}

function votar($fase, $gos){
  $idFase = idFase($fase);
  $idGos = idGos($gos);
  insertarVot($idFase, $idGos);
}

function treureVot($fase, $gos){
  $idFase = idFase($fase);
  $idGos = idGos($gos);
  echo $idFase . '   '.$idGos;
  eliminarVot($idFase, $idGos);
}

function consultarVots($fase){
  $dbh = connexio();
  $idFase = idFase($fase);
  $stmt = $dbh -> prepare("SELECT count(*), gosid, faseid FROM resultat WHERE faseid = ? GROUP BY gosid, faseid;");
  $stmt->execute(array($idFase));
  foreach($stmt as $votacio){
    $llistVotacions[] = $votacio;
  }
  return $llistVotacions;
}


?>