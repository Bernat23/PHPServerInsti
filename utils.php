<?php
const FILE_USERS = 'users.json';
const FILE_CONNX = 'connections.json';

/**
 * Llegeix les dades del fitxer. Si el document no existeix torna un array buit.
 *
 * @param string $file
 * @return array
 */
function llegeix(string $file) : array
{
    $var = [];
    if ( file_exists($file) ) {
        $var = json_decode(file_get_contents($file), true);
    }
    return $var;
}

/**
 * Guarda les dades a un fitxer
 *
 * @param array $dades
 * @param string $file
 */
function escriu(array $dades, string $file): void
{
    file_put_contents($file,json_encode($dades, JSON_PRETTY_PRINT));
}

/**
 * Mostra les connexions d'un usuari amb status success
 *
 * @param string $email
 * @return string
 */
function print_conns(string $email): string{
    $output = "";
    $data = llegeix(FILE_CONNX);

    foreach ($data as $vals){
        if($vals["user"] == $email && str_contains($vals["status"], "success"))
            $output .= "Connexió des de " . $vals["ip"] . " amb data " . $vals["time"]. "<br>\n";
    }

    return $output;
}

function iniciar_connexio(){
    try {
        $hostname = "localhost";
        $dbname = "dwes_bernatpujolriu_autpdo";
        $username = "dwes-user";
        $pw = "dwes-pass";
        $dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
      }
      return $dbh;
}

function llegir_connexions(string $email){
    $output = "";
    $dbh = iniciar_connexio();
    $stmt = $dbh->prepare("select ip, user, time1, status1 FROM connexions");
    $stmt->execute();
    foreach($stmt as $row){
        if($email == $row['user']){
            $output .= $row['ip']. ', '.$row['user']. ', '.$row['time1']. ', '.$row['status1'].'<br>';    
        }

    }
    return $output;
}

function comprovar_signin($email, $contrasenya) {
    $dbh = iniciar_connexio();
    $emailCorrecte = false;
    $stmt = $dbh->prepare("select nom, usuari, contrasenya FROM identificats");
    $stmt->execute();
    foreach($stmt as $row){
        if($row['usuari'] == $email){
            $emailCorrecte = true;
            echo '<br>' . $contrasenya . '<br>' . $row['contrasenya'];
            if($contrasenya == $row['contrasenya']){
                return $row['nom'];
            }
        }
    }
    if($emailCorrecte){
        return 'incorrecte';
    }
    return null;
}

function comprovar_signup($nom ,$email, $contrasenya) {
    $dbh = iniciar_connexio();
    $stmt = $dbh->prepare("select nom, usuari, contrasenya FROM identificats");
    $stmt->execute();
    foreach($stmt as $row){
        if($row['usuari'] == $email){
            return "signup_exist_error";
        }
    }
    $stmt = $dbh->prepare("INSERT INTO identificats (nom, usuari, contrasenya) VALUES(?,?,MD5(?))"); 
    $stmt->execute( array($nom,$email, $contrasenya));
    return "signup_success";
}


