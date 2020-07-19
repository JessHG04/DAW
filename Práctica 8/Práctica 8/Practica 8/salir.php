<?php
    session_start();
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
    setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() - 60*60*24*90));
    setcookie("contrasenya_usuario", $_SESSION["contrasenyaUsu"], (time() - 60*60*24*90));
    setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() - 60*60*24*90));
    setcookie("last_visit", $current_visit, (time() - 60*60*24*90));
    session_destroy();
    header('Location: index.php');
?>
