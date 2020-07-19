<?php
    $title = "Subir Foto - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
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
    $paisCorrecto = $albCorrecto = $fotoCorrecto = false;


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
        if(isset($fechaF) && $fechaF != "") {
            if(checkdate(date_format($fechaF, 'm'), date_format($fechaF, 'd'), date_format($fechaF, 'Y'))){
                if(date_format($fechaF, 'Y') > date('Y')){
                    $errorReg = "No es una fecha válida <br>Esa fecha aún no ha llegado";
                } else{
                    $fNacCorrecta = true;
                }
            } else{
                $errorReg = "No es una fecha válida";
            }
        } else{
            $fechaF = date_create(date('Y-m-d'));
        }
        /* Antes lo hacia asi:
        if(date_timestamp_get($fechaF) != ""){
            if(date_timestamp_get($fechaF) > date_timestamp_get($fechaActual)) {
                $fechaF = date_create(date('Y-m-d'));
            }
        } else{
            $fechaF = date_create(date('Y-m-d'));
        }
        */
    } else{
        //echo "hii" . $_POST["fechaFoto"];
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
        $usuarios = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='{$_SESSION["nameUsu"]}'";
        if(!($resultadoUsuarios = $mysqli->query($usuarios))) {
            echo "<p>Error al ejecutar la sentencia <b>$usuarios</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaUsu = $resultadoUsuarios->fetch_object()){
            $idUsu = $filaUsu->IdUsuario;
            break;
        }
        $resultadoUsuarios->close();
        $albFoto = $mysqli->real_escape_string($_POST["albumFoto"]);
        $albumes = "SELECT * FROM pibd.albumes where albumes.Titulo='$albFoto' and albumes.Usuario ='$idUsu'";
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

    //FOTO || FICHERO
    if($errorCreaFoto == null) {
        /*print_r($_FILES);
        echo "<br><br>";*/
        $msgError = array(0 => "No hay error, el fichero se subió con éxito",
                        1 => "El tamaño del fichero supera la directiva
                            upload_max_filesize el php.ini",
                        2 => "El tamaño del fichero supera la directiva
                            MAX_FILE_SIZE especificada en el formulario HTML",
                        3 => "El fichero fue parcialmente subido",
                        4 => "No se ha subido un fichero",
                        6 => "No existe un directorio temporal",
                        7 => "Fallo al escribir el fichero al disco",
                        8 => "La subida del fichero fue detenida por la extensión");

        if($_FILES["nfileFoto"]["error"] > 0) {
            //echo "Error: " . $msgError[$_FILES["nfileFoto"]["error"]] . "<br />";
            /*
            if($_FILES["nfileFoto"]["error"] == 4){
                $fotoCorrecto = true;
            } else{
                $errorCreaFoto = $msgError[$_FILES["nfileFoto"]["error"]];
            }
            */
            if($_FILES["nfileFoto"]["error"] != 4){
                $errorCreaFoto = $msgError[$_FILES["nfileFoto"]["error"]];
            }
        } else {
            //Comprobando tipos: image/gif, image/jpeg, ....
            $tipoFichero = $_FILES["nfileFoto"]["type"];
            $esImagen = explode("/", $tipoFichero);

            if($esImagen[0] == "image"){
                $carpeta = "images/FotosUsuarios/" . $_SESSION["nameUsu"] . "/";
                //echo $carpeta . "<br>";
                if(!file_exists("C:\\xampp\\htdocs\\DAW\\Practica 10\\" . $carpeta)) {
                    mkdir($carpeta, 0700);
                }
                $nombreFoto = $carpeta . $_SESSION["nameUsu"] . "-" . rand() . "-" . $_FILES["nfileFoto"]["name"];
                move_uploaded_file($_FILES["nfileFoto"]["tmp_name"], "C:\\xampp\\htdocs\\DAW\\Practica 10\\" . $nombreFoto);
                $fotoCorrecto = true;
                //echo  $nombreFoto;
            } else{
                $errorCreaFoto = "El fichero NO es una imagen";
            }
        }
    }

    if($errorCreaFoto == null){
        $insertarFoto = true;
        if($fotoCorrecto && isset($nombreFoto)){
            $fotoNom = '"' . $nombreFoto . '"';
        } else{
            $fotoNom = "No ha seleccionado";
        }

        $tituloFo = $mysqli->real_escape_string($_POST['tituloFoto']);
        $descFo = $mysqli->real_escape_string($_POST['descFoto']);
        $fechaFo = date_format($fechaF, 'Y-m-d');
        $fileFo = $fotoNom;
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
        //echo $fileFo;
        if(!$fotoCorrecto){
            $fileFo = '"images/user.png"';
            $insertarFoto = false;
            $errorCreaFoto = "No ha seleccionado foto";
        } else {
            $fileFo = $fileFo;// <-- en el futuro meterlo asi
            //$fileFo = '"images/user.png"';
        }
        //echo "1-->" . $fileFo;
        //echo "Foto: $fileFo<br> Pais: $paNomReg --> $paIdReg<br> Ciudad: $ciReg<br>";
        //Antes insertaba aqui
        /* Lo que hacia antes:
        if(!$fotoCorrecto){
            $insertarFoto = false;
            $errorCreaFoto = "No ha seleccionado foto";
        } else{
            //$fileFo = '"' . $fileFo . '"'; //en el futuro meterlo asi
            $fileFo = '"images/user.png"';
        }
        */
        //ALTERNATIVO
        if(empty($altFo)){
            $altFo = "";
        }
        //DESCRIPCION
        if(empty($descFo)){
            $descFo = "";
        }

        /*
        $fotos = "SELECT * FROM pibd.fotos where fotos.Titulo='$tituloFo'";
        if(!($resultadoFotos = $mysqli->query($fotos))) {
            echo "<p>Error al ejecutar la sentencia <b>$fotos</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaFoto = $resultadoFotos->fetch_object()){
            if($filaFoto){

            }
            $insertarFoto = false;
            $errorCreaFoto = "Esta foto ya se ha subido";
            break;
        }
        $resultadoFotos->close();
        */
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
                        <b>Foto: </b> <br> <img src=$fileFo alt='$altFo' width='200'> <br>
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