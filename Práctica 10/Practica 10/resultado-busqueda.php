<?php
    $title = "Resultado de búsqueda - Photory";
    require_once("head.inc.php");
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
    require_once("header.inc.php");


    echo "<main><section><h2>Resultado de búsqueda de imágenes</h2><p>";
    $buscarTitulo  = $buscarFecha = $buscarPais = null;
    $hacerPais = false;



    /*MUESTRO LA BUSQUEDA: */
    echo "<b>Titulo: </b>";
    if(isset($_POST["tituloAvan"])){
        $buscarTitulo = $_POST["tituloAvan"];
        echo $_POST["tituloAvan"];
    }
    echo "<br>";

    echo "<b>Fecha: </b>";
    if(isset($_POST["fechaAvan"]) && $_POST["fechaAvan"] != ""){
        $buscarFecha = $_POST["fechaAvan"];
        $fechaBusqueda = date_create($_POST["fechaAvan"]);
        echo date_format($fechaBusqueda, 'd/m/Y');
    }
    echo "<br>";

    echo "<b>País: </b>";
    if(isset($_POST["paisAvan"])){
        if($_POST["paisAvan"] != "Seleccione..." && $_POST["paisAvan"] != "..."){
            $buscarPais = $_POST["paisAvan"];
            echo $_POST["paisAvan"];
        }
    }
    echo "<br>";



    /*NO HA INTRODUCIDO NADA EN LA BUSQUEDA*/
    if((!isset($buscarTitulo) || $buscarTitulo == "") && !isset($buscarFecha) && !isset($buscarPais)) {
        echo "<p class='error' style='text-align:center; font-weight:bold; font-size: 1.1em;'>NO HA INTRODUCIDO NADA EN LA BÚSQUEDA</p>";
    }

    /*HAGO LAS SELECT SEGUN LOS DATOS INTRODUCIDOS*/
    /*SI TENGO: Pais*/
    if(isset($buscarPais)){
        $paisF = "SELECT * FROM pibd.paises where paises.NomPais LIKE '%$buscarPais%'";
        if(!($resultadoPaisF = $mysqli->query($paisF))) {
            echo "<p>Error al ejecutar la sentencia <b>$paisF</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        while($filaPaisF = $resultadoPaisF->fetch_object()) {
            $fotos = "SELECT * FROM pibd.fotos where fotos.Pais = $filaPaisF->IdPais";
        }
    }
    /*SI TENGO: Fecha*/
    if(isset($buscarFecha)){
        if(isset($resultadoPaisF)){
            $fotos = $fotos . " and fotos.Fecha = '$buscarFecha'";
        } else{
            $fotos = "SELECT * FROM pibd.fotos where fotos.Fecha = '$buscarFecha'";
        }

    }
    /*SI TENGO: Titulo*/
    if(isset($buscarTitulo) && $buscarTitulo != ""){
        if(isset($resultadoPaisF)){
            $fotos = $fotos . " and fotos.Titulo LIKE '%$buscarTitulo%'";
        } else if(isset($fotos)){
            $fotos = $fotos . " and fotos.Titulo LIKE '%$buscarTitulo%'";
        } else{
            $fotos = "SELECT * FROM pibd.fotos where fotos.Titulo LIKE '%$buscarTitulo%'";
        }
    }
    if(isset($fotos)){
        if(!($resultadoFotos = $mysqli->query($fotos))) {
            echo "<p>Error al ejecutar la sentencia <b>$fotos</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
    }

    echo "</p>";
    /*MUESTRO LAS IMAGENES DE LA BUSQUEDA*/
    if(isset($resultadoFotos)){
        echo "<div>";
        while($filaFotos = $resultadoFotos->fetch_object()) {
            $fechaFoto = date_create($filaFotos->Fecha);
echo <<<hearDOC
            <figure>
                <a href="foto-id.php?id=$filaFotos->IdFoto">
                    <img src=$filaFotos->Fichero alt="$filaFotos->Alternativo" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=$filaFotos->IdFoto">$filaFotos->Titulo</a> <br>
                        <b>Fecha:</b> <time datetime="$filaFotos->Fecha">
hearDOC;
            echo date_format($fechaFoto, 'd/m/Y') . "</time> <br>";
            $NombresPaises = "SELECT paises.* FROM pibd.paises where $filaFotos->Pais = paises.IdPais";
            if(!($resultadoNomPais = $mysqli->query($NombresPaises))) {
                echo "<p>Error al ejecutar la sentencia <b>$NombresPaises</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($filaFotos2 = $resultadoNomPais->fetch_object()){
echo <<<hearDOC
                        <b>País:</b> $filaFotos2->NomPais
                    </p>
                </figcaption>
            </figure>
hearDOC;
            }
        }
        if(isset($resultadoNomPais)){
            $resultadoNomPais->close();
        }
        if(isset($resultadoFotos)){
            $resultadoFotos->close();
        }
        if(isset($resultadoPaisF)){
            $resultadoPaisF->close();
        }
        echo "</div>";
    }
    echo "</section></main>";

    require_once("footer.inc.php");
?>