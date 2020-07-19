<?php
    $title = "Photory";
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "true";
    if(isset($_SESSION['nameUsu'])){
        $subirFoto = "true";
        $miPerfil = "true";
        $iniciarSesion = "false";
        $registrate = "false";
    }
    /*
    <a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
    <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>

    <a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
    <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>
    */
    require_once("head.inc.php");
    require_once("header.inc.php");
?>

<main>
    <p>Aqui va lo distinto</p>
</main>

<?php
    require_once("footer.inc");
?>