<?php
session_start();
if(isset($_SESSION["admin"])){ //Comprovem que ja és admin
    if($_SESSION["admin"] == true){
        header("Location: paginaAdmin.php", true, 303);
    }
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Accés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="processAdmin.php" method="post">
                <h1>Inicia la sessió</h1>
                <br>
                <span>Introdueix les teves credencials</span>
                <br>
                <input type="hidden" name="method" value="signin"/>
                <br>
                <input type="text" name="admin" placeholder="Usuari" />
                <br>
                <input type="password" name="contrasenya" placeholder="Contrasenya" />
                <br>
                <button>Inicia la sessió</button>
            </form>
        </div>
    </div>
</body>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</html>