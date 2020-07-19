<?php
    $title = "Subir Foto - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

    //echo $_SESSION['nombreAlbum'];
    $errorCreaFoto = null;
    $todoCorrecto = false;
    //TITULO
    if(empty($_POST["tituloFoto"])) {
        $errorCreaFoto = "No ha seleccionado";
    }
    //FECHA FOTO
    if(!empty($_POST["fechaFoto"])) {
        $fechaF = date_create($_POST["fechaFoto"]);
        $fechaActual = date_create(date('d/m/Y'));
        //echo "fecha nacimiento: " . date_format($fechaF, 'd/m/Y') . " --> " . date_timestamp_get($fechaF) . "<br>";
        //echo "fecha actual: " . date('d/m/Y') . " --> " . date_timestamp_get($fechaActual) . "<br>";
        if(date_timestamp_get($fechaF) != ""){
            if(date_timestamp_get($fechaF) > date_timestamp_get($fechaActual)) {
                $fechaF = date_create(date('Y-m-d'));
            }
        } else{
            $fechaF = date_create(date('Y-m-d'));
        }
    } else{
        $fechaF = date_create(date('Y-m-d'));
    }
    //PAIS
    if(!empty($_POST["paisFoto"]) && $_POST["paisFoto"] != "Seleccione..." && $_POST["paisFoto"] != "..."){
        $paisFoto = $mysqli->real_escape_string($_POST["paisFoto"]);
        $paises = "SELECT * FROM pibd.paises where paises.NomPais='$paisFoto'";
        if(!($resultadoPaises = $mysqli->query($paises))) {
            echo "<p>Error al ejecutar la sentencia <b>$paises</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaPais = $resultadoPaises->fetch_object()){
            $paIdFo = $filaPais->IdPais;
            $paisCorrecto = true;
            break;
        }
        $resultadoPaises->close();
        if(!$paisCorrecto){
            $errorCreaFoto = "No ha seleccionado pais";
        }
    } else{
        $errorCreaFoto = "No ha seleccionado pais";
    }
    //ALBUM
    if(!empty($_POST["albumFoto"]) && $_POST["albumFoto"] != "Seleccione..." && $_POST["albumFoto"] != "..."){
        $albFoto = $mysqli->real_escape_string($_POST["albumFoto"]);
        $albumes = "SELECT * FROM pibd.albumes where albumes.Titulo='$albFoto'";
        if(!($resultadoAlbumes = $mysqli->query($albumes))) {
            echo "<p>Error al ejecutar la sentencia <b>$albumes</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaAlbum = $resultadoAlbumes->fetch_object()){
            $albIdFo = $filaAlbum->IdAlbum;
            $albCorrecto = true;
            break;
        }
        $resultadoAlbumes->close();
        if(!$albCorrecto){
            $errorCreaFoto = "No ha seleccionado álbum";
        }
    } else{
        $errorCreaFoto = "No ha seleccionado álbum";
    }

    if($errorCreaFoto == null){
        $insertarFoto = true;
        $tituloFo = $mysqli->real_escape_string($_POST['tituloFoto']);
        $descFo = $mysqli->real_escape_string($_POST['descFoto']);
        $fechaFo = date_format($fechaF, 'Y-m-d');
        $fileFo = $mysqli->real_escape_string($_POST['fileFoto']);
        $altFo = $mysqli->real_escape_string($_POST['alternativoFoto']);
        //PAIS
        if(!isset($paIdFo) || empty($paIdFo)){
            $paIdFo = "";
            $insertarFoto = false;
        }
        //ALBUM
        if(!isset($albIdFo) || empty($albIdFo)){
            $albIdFo = "";
            $insertarFoto = false;
        }
        //FOTO
        if(empty($fileFo)){
            $insertarFoto = false;
            $errorCreaFoto = "No ha seleccionado foto";
        } else{
            //$fileFo = '"' . $fileFo . '"'; //en el futuro meterlo asi
            $fileFo = '"images/user.png"';
        }
        //ALTERNATIVO
        if(empty($altFo)){
            $altFo = "";
        }
        //DESCRIPCION
        if(empty($descFo)){
            $descFo = "";
        }

        $fotos = "SELECT * FROM pibd.fotos where fotos.Titulo='$tituloFo'";
        if(!($resultadoFotos = $mysqli->query($fotos))) {
            echo "<p>Error al ejecutar la sentencia <b>$fotos</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaFoto = $resultadoFotos->fetch_object()){
            $insertarFoto = false;
            $errorCreaFoto = "Esta foto ya se ha subido";
            break;
        }
        $resultadoFotos->close();

        if($insertarFoto){
            $insertFoto = "INSERT INTO pibd.fotos (Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo) VALUES ('$tituloFo', '$descFo', '$fechaFo', '$paIdFo', '$albIdFo', '$fileFo', '$altFo')";
            if ($mysqli->query($insertFoto) === TRUE) {
                $todoCorrecto = true;
            } else {
                echo "Error: " . $insertFoto . "<br>" . $mysqli->error;
            }
        }
    }

    if($todoCorrecto){
        echo <<<hereDOC
            <main>
                <section>
                    <p>
                        <h2 style="color:green;">Se ha subido correctamente la foto</h2>
                        <b>Titulo: </b> $tituloFo<br>
                        <b>Descripcion: </b> $descFo<br>
                        <b>Fecha: </b>
hereDOC;
        echo date_format($fechaF, 'd/m/Y') . "<br>";
        echo <<<hereDOC
                        <b>Pais: </b> {$_POST["paisFoto"]}<br>
                        <b>Album: </b> {$_POST["albumFoto"]}<br>
                        <b>Fichero: </b> $fileFo<br>
                        <b>Alternativo: </b> $altFo<br>
                    </p>
                </section>
            </main>
hereDOC;
    } else{
        echo <<<hereDOC
            <main>
                <section>
                    <p>
                        <h2 class='error'>Ha habido un error al subir la foto</h2>
                        $errorCreaFoto
                    </p>
                </section>
            </main>
hereDOC;
    }

    require_once("footer.inc.php");
?>