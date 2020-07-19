<?php
    $title = "Registro - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "false";
    if(isset($_SESSION['nameUsu'])){
        header('Location: menu-usuario.php');
    }
    require_once("header.inc.php");

    $titleFormReg = "Registro";
    $titleButtonReg = "Registrarse";
    $enlaceFormReg = "registro-respuesta.php";
    echo "<main>";

    $nombreUsuReg = $contrUsuReg = $contr2UsuReg = $emailUsuReg = $fNacUsuReg = $paisUsuReg = $ciudadUsuReg = "";
    $sexoUsuReg = 2;

    require_once("formulario-registro.php");
    echo "</main>";


    require_once("footer.inc.php");
?>