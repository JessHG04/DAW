<?php
    session_start();
    require_once("conexionBDD.inc.php");
    /*
    $usuarios = array("usuario1", "usuario2", "usuario3", "usuario4");
    $contrasenyas = array("pass1", "pass2", "pass3", "pass4");
    $estilos = array("adaptativo", "accesible", "normal", "impresion");
    */
    $usuarios = array();
    $contrasenyas = array();
    $estilos = array();

    $DatosUsuarios = 'SELECT * FROM pibd.usuarios';
    if(!($resultadoDatosUsus = $mysqli->query($DatosUsuarios))) {
        echo "<p>Error al ejecutar la sentencia <b>$DatosUsuarios</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    while($filaDatosUsus = $resultadoDatosUsus->fetch_object()) {
        $usuarios[] = $filaDatosUsus->NomUsuario;
        $contrasenyas[] = $filaDatosUsus->Clave;

        $DatosEstilos = "SELECT estilos.* FROM pibd.estilos where $filaDatosUsus->Estilo = estilos.IdEstilo";
        if(!($resultadoDatosEstilos = $mysqli->query($DatosEstilos))) {
            echo "<p>Error al ejecutar la sentencia <b>$DatosEstilos</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        while($filaDatosEstilos = $resultadoDatosEstilos->fetch_object()) {
            $estilos[] = $filaDatosEstilos->Fichero;
            /*
            echo "*";
            echo " Nombre = " . $filaDatosUsus->NomUsuario . " y Clave = " . $filaDatosUsus->Clave . "<br>";
            echo "Estilo = " . $filaDatosEstilos->Fichero . "<br><br>";
            */
        }
    }

    if(basename($_SERVER["REQUEST_URI"]) != "iniciar-sesion.php"){
        require_once("comprobacionCookies.php");
    }
    // Libera la memoria ocupada por los resultados
    $resultadoDatosUsus->close();
    $resultadoDatosEstilos->close();
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