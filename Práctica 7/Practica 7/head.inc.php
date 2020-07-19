<?php
    session_start();
    $usuarios = array("usuario1", "usuario2", "usuario3", "usuario4");
    $contrasenyas = array("pass1", "pass2", "pass3", "pass4");
    $estilos = array("adaptativo", "accesible", "normal", "impresion");
    if(basename($_SERVER["REQUEST_URI"]) != "iniciar-sesion.php"){
        require_once("comprobacionCookies.php");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0" />
    <meta name="description" content="Sitio web de gestión de álbumes de fotos">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="images/Logo2.png"/>
    <link rel="stylesheet" type="text/css" href="css/fontello.css"/>
<?php
    echo '<link rel="stylesheet" type="text/css" href="css/estilo.css"/>';
    if(isset($_SESSION["nameUsu"])) {
        if(isset($_SESSION["estiloUsu"])){
            if($_SESSION["estiloUsu"] == "normal"){
                echo '<link rel="stylesheet" type="text/css" href="css/estilo.css"/>';
            } else if($_SESSION["estiloUsu"] == "impresion"){
                echo '<link rel="stylesheet" type="text/css" href="css/print.css"/>';
            } else if($_SESSION["estiloUsu"] == "accesible"){
                echo '<link rel="stylesheet" type="text/css" href="css/accesible.css"/>';
            } else if($_SESSION["estiloUsu"] == "adaptativo"){
                echo '<link rel="stylesheet" type="text/css" href="css/adaptativo.css"/>';
            } else{
                echo '<link rel="stylesheet" type="text/css" href="css/estilo.css"/>';
            }
        }
    }
?>
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>

    <link rel="alternate stylesheet" type="text/css" href="css/estilo.css" title="Estilo normal"/>
    <link rel="alternate stylesheet" type="text/css" href="css/print.css" title="Estilo impresión"/>
    <link rel="alternate stylesheet" type="text/css" href="css/accesible.css" title="Estilo accesible"/>
    <link rel="alternate stylesheet" type="text/css" href="css/adaptativo.css" title="Estilo adaptativo"/>
    <title><?php echo $title; ?></title>
</head>

<body>